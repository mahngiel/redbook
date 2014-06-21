<?php

/**
 * @param string $timestamp
 * @param string $timezone
 *
 * @return array|int|string
 */
function timestamp( $timestamp = '', $timezone = 'UTC' )
{
    //$value = mysql_to_unix($timestamp);

    return gmt_to_local( $timestamp, $timezone );
}

/**
 * @param $birth
 * @param $now
 *
 * @return string
 */
function getAge( $birth, $now )
{

    $now   = new DateTime( $now );
    $birth = new DateTime( $birth );

    return $birth->diff( $now )->format( '%r%y' );
}

/**
 * @param $num
 *
 * @return string
 */
function ordinal( $num )
{
    $ends = array( 'th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th' );

    return ( ( $num % 100 ) >= 11 && ( $num % 100 ) <= 13 ) ? $num . 'th' : $num . $ends[$num % 10];
}

// ------------------------------------------------------------------------

/**
 * Convert MySQL Style Datecodes
 *
 * This function is identical to PHPs date() function,
 * except that it allows date codes to be formatted using
 * the MySQL style, where each code letter is preceded
 * with a percent sign:  %Y %m %d etc...
 *
 * The benefit of doing dates this way is that you don't
 * have to worry about escaping your text letters that
 * match the date codes.
 *
 * @access    public
 *
 * @param    string
 * @param    integer
 *
 * @return    integer
 */
if (!function_exists( 'mdate' ))
{
    /**
     * @param string $datestr
     * @param string $time
     *
     * @return bool|string
     */
    function mdate( $datestr = '', $time = '' )
    {
        if ($datestr == '')
        {
            return '';
        }

        if ($time == '')
        {
            $time = now();
        }

        $datestr = str_replace( '%\\', '', preg_replace( "/([a-z]+?){1}/i", "\\\\\\1", $datestr ) );

        return date( $datestr, $time );
    }
}

// ------------------------------------------------------------------------

/**
 * Standard Date
 *
 * Returns a date formatted according to the submitted standard.
 *
 * @access    public
 *
 * @param    string     the chosen format
 * @param    integer    Unix timestamp
 *
 * @return    string
 */
if (!function_exists( 'standard_date' ))
{
    /**
     * @param string $fmt
     * @param string $time
     *
     * @return bool|string
     */
    function standard_date( $fmt = 'DATE_RFC822', $time = '' )
    {
        $formats = array(
            'DATE_ATOM'    => '%Y-%m-%dT%H:%i:%s%Q',
            'DATE_COOKIE'  => '%l, %d-%M-%y %H:%i:%s UTC',
            'DATE_ISO8601' => '%Y-%m-%dT%H:%i:%s%Q',
            'DATE_RFC822'  => '%D, %d %M %y %H:%i:%s %O',
            'DATE_RFC850'  => '%l, %d-%M-%y %H:%m:%i UTC',
            'DATE_RFC1036' => '%D, %d %M %y %H:%i:%s %O',
            'DATE_RFC1123' => '%D, %d %M %Y %H:%i:%s %O',
            'DATE_RSS'     => '%D, %d %M %Y %H:%i:%s %O',
            'DATE_W3C'     => '%Y-%m-%dT%H:%i:%s%Q'
        );

        if (!isset( $formats[$fmt] ))
        {
            return false;
        }

        return mdate( $formats[$fmt], $time );
    }
}

// ------------------------------------------------------------------------

/**
 * Number of days in a month
 *
 * Takes a month/year as input and returns the number of days
 * for the given month/year. Takes leap years into consideration.
 *
 * @access    public
 *
 * @param    integer    a numeric month
 * @param    integer    a numeric year
 *
 * @return    integer
 */
if (!function_exists( 'days_in_month' ))
{
    /**
     * @param int    $month
     * @param string $year
     *
     * @return int
     */
    function days_in_month( $month = 0, $year = '' )
    {
        if ($month < 1 OR $month > 12)
        {
            return 0;
        }

        if (!is_numeric( $year ) OR strlen( $year ) != 4)
        {
            $year = date( 'Y' );
        }

        if ($month == 2)
        {
            if ($year % 400 == 0 OR ( $year % 4 == 0 AND $year % 100 != 0 ))
            {
                return 29;
            }
        }

        $days_in_month = array( 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );

        return $days_in_month[$month - 1];
    }
}

// ------------------------------------------------------------------------

/**
 * Converts a local Unix timestamp to GMT
 *
 * @access    public
 *
 * @param    integer Unix timestamp
 *
 * @return    integer
 */
if (!function_exists( 'local_to_gmt' ))
{
    /**
     * @param string $time
     *
     * @return int
     */
    function local_to_gmt( $time = '' )
    {
        if ($time == '')
        {
            $time = time();
        }

        return mktime( gmdate( "H", $time ), gmdate( "i", $time ), gmdate( "s", $time ), gmdate( "m", $time ), gmdate( "d", $time ), gmdate( "Y", $time ) );
    }
}

// ------------------------------------------------------------------------

/**
 * Converts GMT time to a localized value
 *
 * Takes a Unix timestamp (in GMT) as input, and returns
 * at the local value based on the timezone and DST setting
 * submitted
 *
 * @access    public
 *
 * @param    integer   Unix timestamp
 * @param    string    timezone
 * @param    bool      whether DST is active
 *
 * @return    integer
 */
if (!function_exists( 'gmt_to_local' ))
{
    /**
     * @param string $time
     * @param string $timezone
     * @param bool   $dst
     *
     * @return array|int|string
     */
    function gmt_to_local( $time = '', $timezone = 'UTC', $dst = false )
    {
        if ($time == '')
        {
            return time();
        }

        $time += timezones( $timezone ) * 3600;

        if ($dst == true)
        {
            $time += 3600;
        }

        return $time;
    }
}

// ------------------------------------------------------------------------

/**
 * Converts a MySQL Timestamp to Unix
 *
 * @access    public
 *
 * @param    integer Unix timestamp
 *
 * @return    integer
 */
if (!function_exists( 'mysql_to_unix' ))
{
    /**
     * @param string $time
     *
     * @return int
     */
    function mysql_to_unix( $time = '' )
    {
        // We'll remove certain characters for backward compatibility
        // since the formatting changed with MySQL 4.1
        // YYYY-MM-DD HH:MM:SS

        $time = str_replace( '-', '', $time );
        $time = str_replace( ':', '', $time );
        $time = str_replace( ' ', '', $time );

        // YYYYMMDDHHMMSS
        return mktime(
            substr( $time, 8, 2 ),
            substr( $time, 10, 2 ),
            substr( $time, 12, 2 ),
            substr( $time, 4, 2 ),
            substr( $time, 6, 2 ),
            substr( $time, 0, 4 )
        );
    }
}

// ------------------------------------------------------------------------

/**
 * Unix to "Human"
 *
 * Formats Unix timestamp to the following prototype: 2006-08-21 11:35 PM
 *
 * @access    public
 *
 * @param    integer   Unix timestamp
 * @param    bool      whether to show seconds
 * @param    string    format: us or euro
 *
 * @return    string
 */
if (!function_exists( 'unix_to_human' ))
{
    /**
     * @param string $time
     * @param bool   $seconds
     * @param string $fmt
     *
     * @return string
     */
    function unix_to_human( $time = '', $seconds = false, $fmt = 'us' )
    {
        $r = date( 'Y', $time ) . '-' . date( 'm', $time ) . '-' . date( 'd', $time ) . ' ';

        if ($fmt == 'us')
        {
            $r .= date( 'h', $time ) . ':' . date( 'i', $time );
        }
        else
        {
            $r .= date( 'H', $time ) . ':' . date( 'i', $time );
        }

        if ($seconds)
        {
            $r .= ':' . date( 's', $time );
        }

        if ($fmt == 'us')
        {
            $r .= ' ' . date( 'A', $time );
        }

        return $r;
    }
}

// ------------------------------------------------------------------------

/**
 * Convert "human" date to GMT
 *
 * Reverses the above process
 *
 * @access    public
 *
 * @param    string    format: us or euro
 *
 * @return    integer
 */
if (!function_exists( 'human_to_unix' ))
{
    /**
     * @param string $datestr
     *
     * @return bool|int
     */
    function human_to_unix( $datestr = '' )
    {
        if ($datestr == '')
        {
            return false;
        }

        $datestr = trim( $datestr );
        $datestr = preg_replace( "/\040+/", ' ', $datestr );

        if (!preg_match( '/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}\s[0-9]{1,2}:[0-9]{1,2}(?::[0-9]{1,2})?(?:\s[AP]M)?$/i', $datestr ))
        {
            return false;
        }

        $split = explode( ' ', $datestr );

        $ex = explode( "-", $split['0'] );

        $year  = ( strlen( $ex['0'] ) == 2 ) ? '20' . $ex['0'] : $ex['0'];
        $month = ( strlen( $ex['1'] ) == 1 ) ? '0' . $ex['1'] : $ex['1'];
        $day   = ( strlen( $ex['2'] ) == 1 ) ? '0' . $ex['2'] : $ex['2'];

        $ex = explode( ":", $split['1'] );

        $hour = ( strlen( $ex['0'] ) == 1 ) ? '0' . $ex['0'] : $ex['0'];
        $min  = ( strlen( $ex['1'] ) == 1 ) ? '0' . $ex['1'] : $ex['1'];

        if (isset( $ex['2'] ) && preg_match( '/[0-9]{1,2}/', $ex['2'] ))
        {
            $sec = ( strlen( $ex['2'] ) == 1 ) ? '0' . $ex['2'] : $ex['2'];
        }
        else
        {
            // Unless specified, seconds get set to zero.
            $sec = '00';
        }

        if (isset( $split['2'] ))
        {
            $ampm = strtolower( $split['2'] );

            if (substr( $ampm, 0, 1 ) == 'p' AND $hour < 12)
            {
                $hour = $hour + 12;
            }

            if (substr( $ampm, 0, 1 ) == 'a' AND $hour == 12)
            {
                $hour = '00';
            }

            if (strlen( $hour ) == 1)
            {
                $hour = '0' . $hour;
            }
        }

        return mktime( $hour, $min, $sec, $month, $day, $year );
    }
}

// ------------------------------------------------------------------------

/**
 * Timezone Menu
 *
 * Generates a drop-down menu of timezones.
 *
 * @access    public
 *
 * @param    string    timezone
 * @param    string    classname
 * @param    string    menu name
 *
 * @return    string
 */
if (!function_exists( 'timezone_menu' ))
{
    /**
     * @param string $default
     * @param string $class
     * @param string $name
     *
     * @return string
     */
    function timezone_menu( $default = 'UTC', $class = "", $name = 'timezones' )
    {
        if ($default == 'GMT')
        {
            $default = 'UTC';
        }

        $menu = '<select name="' . $name . '"';

        if ($class != '')
        {
            $menu .= ' class="' . $class . '"';
        }

        $menu .= ">\n";

        foreach (timezones() as $key => $val)
        {
            $selected = ( $default == $key ) ? " selected='selected'" : '';
            $menu .= "<option value='{$key}'{$selected}>" . timezone_names( $key ) . "</option>\n";
        }

        $menu .= "</select>";

        return $menu;
    }
}

// ------------------------------------------------------------------------

/**
 * Timezones
 *
 * Returns an array of timezones.  This is a helper function
 * for various other ones in this library
 *
 * @access    public
 *
 * @param    string    timezone
 *
 * @return    string
 */
if (!function_exists( 'timezones' ))
{
    /**
     * @param string $tz
     *
     * @return array|int
     */
    function timezones( $tz = '' )
    {
        // Note: Don't change the order of these even though
        // some items appear to be in the wrong order

        $zones = array(
            'UM12'   => -12,
            'UM11'   => -11,
            'UM10'   => -10,
            'UM95'   => -9.5,
            'UM9'    => -9,
            'UM8'    => -8,
            'UM7'    => -7,
            'UM6'    => -6,
            'UM5'    => -5,
            'UM45'   => -4.5,
            'UM4'    => -4,
            'UM35'   => -3.5,
            'UM3'    => -3,
            'UM2'    => -2,
            'UM1'    => -1,
            'UTC'    => 0,
            'UP1'    => +1,
            'UP2'    => +2,
            'UP3'    => +3,
            'UP35'   => +3.5,
            'UP4'    => +4,
            'UP45'   => +4.5,
            'UP5'    => +5,
            'UP55'   => +5.5,
            'UP575'  => +5.75,
            'UP6'    => +6,
            'UP65'   => +6.5,
            'UP7'    => +7,
            'UP8'    => +8,
            'UP875'  => +8.75,
            'UP9'    => +9,
            'UP95'   => +9.5,
            'UP10'   => +10,
            'UP105'  => +10.5,
            'UP11'   => +11,
            'UP115'  => +11.5,
            'UP12'   => +12,
            'UP1275' => +12.75,
            'UP13'   => +13,
            'UP14'   => +14
        );

        if ($tz == '')
        {
            return $zones;
        }

        if ($tz == 'GMT')
        {
            $tz = 'UTC';
        }

        return ( !isset( $zones[$tz] ) ) ? 0 : $zones[$tz];
    }
}

/**
 * @param $key
 *
 * @return bool
 */
function timezone_names( $key )
{
    $lang           = array();
    $lang['UM12']   = '(UTC -12:00) Baker/Howland Island';
    $lang['UM11']   = '(UTC -11:00) Samoa Time Zone, Niue';
    $lang['UM10']   = '(UTC -10:00) Hawaii-Aleutian Standard Time, Cook Islands, Tahiti';
    $lang['UM95']   = '(UTC -9:30) Marquesas Islands';
    $lang['UM9']    = '(UTC -9:00) Alaska Standard Time, Gambier Islands';
    $lang['UM8']    = '(UTC -8:00) Pacific Standard Time, Clipperton Island';
    $lang['UM7']    = '(UTC -7:00) Mountain Standard Time';
    $lang['UM6']    = '(UTC -6:00) Central Standard Time';
    $lang['UM5']    = '(UTC -5:00) Eastern Standard Time, Western Caribbean Standard Time';
    $lang['UM45']   = '(UTC -4:30) Venezuelan Standard Time';
    $lang['UM4']    = '(UTC -4:00) Atlantic Standard Time, Eastern Caribbean Standard Time';
    $lang['UM35']   = '(UTC -3:30) Newfoundland Standard Time';
    $lang['UM3']    = '(UTC -3:00) Argentina, Brazil, French Guiana, Uruguay';
    $lang['UM2']    = '(UTC -2:00) South Georgia/South Sandwich Islands';
    $lang['UM1']    = '(UTC -1:00) Azores, Cape Verde Islands';
    $lang['UTC']    = '(UTC) Greenwich Mean Time, Western European Time';
    $lang['UP1']    = '(UTC +1:00) Central European Time, West Africa Time';
    $lang['UP2']    = '(UTC +2:00) Central Africa Time, Eastern European Time, Kaliningrad Time';
    $lang['UP3']    = '(UTC +3:00) Moscow Time, East Africa Time';
    $lang['UP35']   = '(UTC +3:30) Iran Standard Time';
    $lang['UP4']    = '(UTC +4:00) Azerbaijan Standard Time, Samara Time';
    $lang['UP45']   = '(UTC +4:30) Afghanistan';
    $lang['UP5']    = '(UTC +5:00) Pakistan Standard Time, Yekaterinburg Time';
    $lang['UP55']   = '(UTC +5:30) Indian Standard Time, Sri Lanka Time';
    $lang['UP575']  = '(UTC +5:45) Nepal Time';
    $lang['UP6']    = '(UTC +6:00) Bangladesh Standard Time, Bhutan Time, Omsk Time';
    $lang['UP65']   = '(UTC +6:30) Cocos Islands, Myanmar';
    $lang['UP7']    = '(UTC +7:00) Krasnoyarsk Time, Cambodia, Laos, Thailand, Vietnam';
    $lang['UP8']    = '(UTC +8:00) Australian Western Standard Time, Beijing Time, Irkutsk Time';
    $lang['UP875']  = '(UTC +8:45) Australian Central Western Standard Time';
    $lang['UP9']    = '(UTC +9:00) Japan Standard Time, Korea Standard Time, Yakutsk Time';
    $lang['UP95']   = '(UTC +9:30) Australian Central Standard Time';
    $lang['UP10']   = '(UTC +10:00) Australian Eastern Standard Time, Vladivostok Time';
    $lang['UP105']  = '(UTC +10:30) Lord Howe Island';
    $lang['UP11']   = '(UTC +11:00) Magadan Time, Solomon Islands, Vanuatu';
    $lang['UP115']  = '(UTC +11:30) Norfolk Island';
    $lang['UP12']   = '(UTC +12:00) Fiji, Gilbert Islands, Kamchatka Time, New Zealand Standard Time';
    $lang['UP1275'] = '(UTC +12:45) Chatham Islands Standard Time';
    $lang['UP13']   = '(UTC +13:00) Phoenix Islands Time, Tonga';
    $lang['UP14']   = '(UTC +14:00) Line Islands';

    if (!$lang[$key])
    {
        return false;
    }

    return $lang[$key];
}


/**
 * Array of countries
 *
 * @return array
 */
function countries()
{
    // Load the countries array
    return $countries = array(
        'af' => 'Afghanistan',
        'al' => 'Albania',
        'dz' => 'Algeria',
        'ad' => 'Andorra',
        'ai' => 'Anguilla',
        'ag' => 'Antigua - Barbuda',
        'ar' => 'Argentina',
        'am' => 'Armenia',
        'aw' => 'Aruba',
        'au' => 'Australia',
        'az' => 'Azerbaijan',
        'bs' => 'Bahamas',
        'bh' => 'Bahrain',
        'bd' => 'Bangladesh',
        'bb' => 'Barbados',
        'by' => 'Belarus',
        'be' => 'Belgium',
        'bz' => 'Belize',
        'bj' => 'Benin',
        'bm' => 'Bermuda',
        'bt' => 'Bhutan',
        'bo' => 'Bolivia',
        'ba' => 'Bosnia',
        'bw' => 'Botswana',
        'br' => 'Brazil',
        'bn' => 'Brunei',
        'bg' => 'Bulgaria',
        'bf' => 'Burkina Faso',
        'bi' => 'Burundi',
        'kh' => 'Cambodia',
        'cm' => 'Cameroon',
        'ca' => 'Canada',
        'cv' => 'Cape Verde',
        'cf' => 'Central Africa Republic',
        'td' => 'Chad',
        'cl' => 'Chile',
        'ci' => 'Christmas Island',
        'cn' => 'China',
        'co' => 'Colombia',
        'cg' => 'Congo',
        'ck' => 'Cook Islands',
        'cr' => 'Costa Rica',
        'ct' => 'Cote D\'Ivoire',
        'hr' => 'Croatia',
        'cu' => 'Cuba',
        'cb' => 'Curacao',
        'cy' => 'Cyprus',
        'cz' => 'Czech Republic',
        'dk' => 'Denmark',
        'dj' => 'Djibouti',
        'dm' => 'Dominica',
        'do' => 'Dominican Republic',
        'ec' => 'Ecuador',
        'eg' => 'Egypt',
        'sv' => 'El Salvador',
        'gq' => 'Equatorial Guinea',
        'er' => 'Eritrea',
        'ee' => 'Estonia',
        'et' => 'Ethiopia',
        'fo' => 'Faroe Islands',
        'fj' => 'Fiji',
        'fi' => 'Finland',
        'fr' => 'France',
        'ge' => 'Georgia',
        'de' => 'Germany',
        'gh' => 'Ghana',
        'gb' => 'Great Britain',
        'gr' => 'Greece',
        'gl' => 'Greenland',
        'gd' => 'Grenada',
        'gp' => 'Guadaloupe',
        'gu' => 'Guam',
        'gt' => 'Guatemala',
        'gn' => 'Guinea',
        'gy' => 'Guyana',
        'ht' => 'Haiti',
        'hn' => 'Honduras',
        'hk' => 'Hong Kong',
        'hu' => 'Hungary',
        'is' => 'Iceland',
        'in' => 'India',
        'id' => 'Indonesia',
        'ia' => 'Iran',
        'iq' => 'Iraq',
        'ir' => 'Ireland',
        'il' => 'Israel',
        'it' => 'Italy',
        'jm' => 'Jamaica',
        'jp' => 'Japan',
        'jo' => 'Jordan',
        'kz' => 'Kazakhstan',
        'ke' => 'Kenya',
        'ki' => 'Kiribati',
        'kr' => 'Korea',
        'kw' => 'Kuwait',
        'kg' => 'Kyrgyzstan',
        'la' => 'Laos',
        'lv' => 'Latvia',
        'lb' => 'Lebanon',
        'lr' => 'Liberia',
        'li' => 'Liechtenstein',
        'lu' => 'Luxembourg',
        'ly' => 'Lybia',
        'mk' => 'Macedonia',
        'my' => 'Malaysia',
        'ml' => 'Mali',
        'mt' => 'Malta',
        'mx' => 'Mexico',
        'md' => 'Moldova',
        'mn' => 'Mongolia',
        'ma' => 'Morocco',
        'mz' => 'Mozambique',
        'mn' => 'Myanmar',
        'na' => 'Namibia',
        'nu' => 'Nauru',
        'np' => 'Nepal',
        'nl' => 'Netherlands',
        'nz' => 'New Zealand',
        'ni' => 'Nicaragua',
        'ne' => 'Niger',
        'ng' => 'Nigeria',
        'no' => 'Norway',
        'om' => 'Oman',
        'pk' => 'Pakistan',
        'pa' => 'Panama',
        'py' => 'Paraguay',
        'pe' => 'Peru',
        'ph' => 'Philippines',
        'pl' => 'Poland',
        'pt' => 'Portugal',
        'pr' => 'Puerto Rico',
        'qa' => 'Qatar',
        'ro' => 'Romania',
        'ru' => 'Russia',
        'rw' => 'Rwanda',
        'lc' => 'St Lucia',
        'sm' => 'San Marino',
        'sa' => 'Saudi Arabia',
        'sn' => 'Senegal',
        'ss' => 'Serbia - Montenegro',
        'sg' => 'Singapore',
        'sk' => 'Slovakia',
        'si' => 'Slovenia',
        'so' => 'Somalia',
        'za' => 'South Africa',
        'es' => 'Spain',
        'sd' => 'Sudan',
        'sr' => 'Suriname',
        'se' => 'Sweden',
        'ch' => 'Switzerland',
        'sy' => 'Syria',
        'tw' => 'Taiwan',
        'th' => 'Thailand',
        'tg' => 'Togo',
        'tk' => 'Tokelau',
        'to' => 'Tonga',
        'tt' => 'Tridinidad Tobago',
        'tn' => 'Tunisia',
        'tr' => 'Turkey',
        'ua' => 'Ukraine',
        'ae' => 'United Arab Emirate',
        'gb' => 'United Kingdom',
        'us' => 'United States',
        'uy' => 'Uruguay',
        'va' => 'Vatican',
        've' => 'Venezuela',
        'vn' => 'Vietnam',
        'za' => 'Zimbawe'
    );
}

/**
 * Retrieve country code from name
 *
 * @param $country_name
 *
 * @return mixed
 */
function find_country( $country_name )
{
    $countries = countries();

    return $countries[$country_name];
}

/**
 * Array of states
 *
 * @return array
 */
function states()
{
    $states = array(
        'AL' => "Alabama",
        'AK' => "Alaska",
        'AZ' => "Arizona",
        'AR' => "Arkansas",
        'CA' => "California",
        'CO' => "Colorado",
        'CT' => "Connecticut",
        'DE' => "Delaware",
        'DC' => "District Of Columbia",
        'FL' => "Florida",
        'GA' => "Georgia",
        'HI' => "Hawaii",
        'ID' => "Idaho",
        'IL' => "Illinois",
        'IN' => "Indiana",
        'IA' => "Iowa",
        'KS' => "Kansas",
        'KY' => "Kentucky",
        'LA' => "Louisiana",
        'ME' => "Maine",
        'MD' => "Maryland",
        'MA' => "Massachusetts",
        'MI' => "Michigan",
        'MN' => "Minnesota",
        'MS' => "Mississippi",
        'MO' => "Missouri",
        'MT' => "Montana",
        'NE' => "Nebraska",
        'NV' => "Nevada",
        'NH' => "New Hampshire",
        'NJ' => "New Jersey",
        'NM' => "New Mexico",
        'NY' => "New York",
        'NC' => "North Carolina",
        'ND' => "North Dakota",
        'OH' => "Ohio",
        'OK' => "Oklahoma",
        'OR' => "Oregon",
        'PA' => "Pennsylvania",
        'RI' => "Rhode Island",
        'SC' => "South Carolina",
        'SD' => "South Dakota",
        'TN' => "Tennessee",
        'TX' => "Texas",
        'UT' => "Utah",
        'VT' => "Vermont",
        'VA' => "Virginia",
        'WA' => "Washington",
        'WV' => "West Virginia",
        'WI' => "Wisconsin",
        'WY' => "Wyoming"
    );

    return $states;
}

/**
 * @param $state
 *
 * @return mixed
 */
function find_state( $state )
{
    $states = states();

    return $states[strtoupper( $state )];
}

/**
 * @param $number
 *
 * @return string
 */
function phone_number( $number )
{
    if (strlen( $number ) == 10)
    {
        if (preg_match( '/(\d{3})(\d{3})(\d{4})$/', $number, $matches ))
        {
            $number = '(' . $matches[1] . ') ' . $matches[2] . '-' . $matches[3];
        }
    }
    elseif (strlen( $number ) == 11)
    {
        if (preg_match( '/(\d{1})(\d{3})(\d{3})(\d{4})$/', $number, $matches ))
        {
            $number = '+' . $matches[1] . ' (' . $matches[2] . ') ' . $matches[3] . '-' . $matches[4];
        }
    }

    return $number;
}

/**
 * @param array $array
 *
 * @return bool
 */
function is_associative( $array = array() )
{
    // Check if the array is an array, make sure it's not empty, and count array keys to make sure its associative
    return ( is_array( $array ) && ( count( $array ) == 0 || 0 !== count( array_diff_key( $array, array_keys( array_keys( $array ) ) ) ) ) );
}

/**
 * Write to a log
 */
function writelog( $arg, $logfile = 'error_log.txt' )
{
    $log = fopen( path( 'logs' ) . $logfile, 'a+b' );

    fwrite( $log, $arg . "\n" );

    fclose( $log );
}

/**
 * @param $string
 *
 * @return string
 */
function truncate( $string )
{
    if (strlen( $string ) > 40)
    {
        $string = str_replace( "\n", '', preg_replace( '/\s+?(\S+)?$/', '', substr( $string, 0, 40 ) ) ) . '...';
    }

    return $string;
}

/**
 * @param $hashArray
 *
 * @return array
 */
function redisHashIntersect( $hashArray )
{
    // return empty
    if (empty( $hashArray ))
    {
        return array();
    }

    // iterate through array
    $outArray = array();
    $lastVar  = null;
    foreach ($hashArray as $key => $value)
    {
        // set even keys as new indices
        if ($key % 2 == 0)
        {
            $outArray[$value] = '';
            // stash val for future reference
            $lastVar = $value;
        }
        else
        {
            // odd keys are values
            $outArray[$lastVar] = $value;
        }
    }

    return $outArray;
}

/**
 * @return array
 */
function disallowedNames()
{
    return array(
        'administration', 'admin', 'sysadmin', 'system', 'tech', 'technician', 'user', 'member', 'lead', 'leader',
        'god', 'jesus', 'allah', 'user', 'username', 'abortion', 'anal', 'anus',
        'ass', 'bastard', 'beastiality', 'bestiality', 'bewb', 'bitch', 'blow', 'blumpkin', 'boob', 'cawk',
        'cock', 'choad', 'cooter', 'cornhole', 'cum', 'cunt', 'dick', 'dildo', 'dong', 'dyke', 'douche',
        'fag', 'faggot', 'fart', 'foreskin', 'fuck', 'fuk', 'gangbang', 'gook', 'handjob', 'hell', 'homo',
        'honkey', 'humping', 'jiz', 'jizz', 'kike', 'kunt', 'labia', 'muff', 'nigger', 'nutsack', 'pen1s',
        'penis', 'piss', 'poon', 'poop', 'punani', 'pussy', 'queef', 'queer', 'quim', 'rimjob', 'rape',
        'rectal', 'rectum', 'semen', 'sex', 'shit', 'slut', 'spick', 'spoo', 'spooge', 'taint', 'titty',
        'titties', 'tits', 'twat', 'vag', 'vagina', 'vulva', 'wank', 'whore',
    );
}

/**
 * Path inside the repository
 *
 * @param string $path
 *
 * @return string
 */
function repository_path( $path = '' )
{
    return '/repository' . ( $path ? '/' . $path . '/' : $path . '/' );
}

/**
 * @param $objects
 */
function debug( $objects )
{
    echo '<pre>';
    print_r( $objects );
    die;
}

/**
 * @param $string
 *
 * @return string
 */
function slugify( $string )
{
    return strtolower( str_replace( ' ', '-', $string ) );
}

/**
 * @param $string
 *
 * @return mixed
 */
function deslugify( $string )
{
    return str_replace( '-', ' ', $string );
}

/**
 * @param array $Objects
 * @param       $asKey
 * @param       $asValue
 *
 * @return array
 */
function createSelectFromArray( array $Objects, $asKey, $asValue )
{
    $selectOptions = array();

    if (empty( $Objects ))
    {
        return $selectOptions;
    }

    foreach ($Objects as $Object)
    {
        if (is_array( $Object ))
        {
            $selectOptions[$Object[$asKey]] = $Object[$asValue];
        }
        else
        {
            $selectOptions[$Object->{$asKey}] = $Object->{$asValue};
        }
    }

    return $selectOptions;
}

function logException( $tag, Exception $exception )
{
    \Log::error( "$tag|" . $exception->getMessage(), array(
        'line'  => $exception->getLine(),
        'file'  => $exception->getFile(),
        'trace' => $exception->getTrace()
    ) );
}

/**
 * Combine namespaces into a singular array
 *
 * @param array  $namespaces
 * @param string $separator
 *
 * @return array
 */
function mapRedisSchema( array $namespaces, $separator = ":" )
{
    // create container for keys
    $container = array();

    // iterate through each key
    foreach ($namespaces as $namespace)
    {
        // break up by the namespace
        $path = explode( $separator, $namespace );

        // create a copy of the container
        $root = & $container;

        // cache last key
        $value = last( $path );

        // glue the element to its predecessor
        while (count( $path ) > 1)
        {
            // take the top key
            $branch = array_shift( $path );

            // make this key an array if not exists
            if (!isset( $root[$branch] ))
            {
                $root[$branch] = array();
            }

            // and attach it to it's predecessor
            $root = & $root[$branch];
        }

        // add the final piece back on
        $root[] = $value;
    }

    return $container;
}

function makeRedisSchemaTree( array $tree, $newRound = true, $oldWord = null )
{
    $out = '';

    if( $oldWord )
    {
        $oldWord .= ':';
    }

    foreach ($tree as $k => $ele)
    {
        if (is_array( $ele ))
        {
            $out .= '<li class=""><i class="entypo entypo-folder"></i> '.$k;
            $out .= '<ul class="">' . makeRedisSchemaTree( $tree[$k], false, $oldWord.$k ) . '</ul>';
            $out .= '</li>';
        }
        else
        {
            $out .= '<li class="key" data-key="'.$oldWord.$ele.'"><i class="entypo entypo-key"></i> '.$oldWord.$ele;
        }
    }

    return $out . '</li>' ;
}

/**
 * Recursively retrieve array key
 *
 * @param $array
 * @param $term
 *
 * @return bool|array
 */
function searchRecursive( $array, $term )
{
    if (!is_array( $array ))
    {
        return false;
    }

    if (isset( $array[$term] ))
    {
        return $array[$term];
    }

    foreach ($array as $key => $subArray)
    {
        // immediate match?
        if ($key === $term)
        {
            return $subArray;
        }

        // iterate children
        if (is_array( $subArray ))
        {
            $results = searchRecursive( $subArray, $term );

            if ($results != false)
            {
                return $results;
            }
        }
    }

    return false;
}
