<!DOCTYPE html>
<html lang="en" ng-app="foundationDemoApp" id="top">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <title>Angular directives for Foundation</title>
  <meta name="description" content="AngularJS (Angular) native
  directives for Foundation. Small footprint (5kB gzipped!),
  no 3rd party JS dependencies (jQuery, Foundation JS) required!
  Widgets: Accordion, Alert, Buttons, Dropdown Toggle, Interchange, Modal, Offcanvas, Pagination, Popover, Progressbar, Rating, Tabs, Tooltip, Topbar, Tour, Typeahead, ">

  <script src="//cdnjs.cloudflare.com/ajax/libs/fastclick/0.6.7/fastclick.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.min.js"></script>
  <script src="<?php echo ASSET_URL; ?>/js/ang/mm-foundation-tpls-0.3.1.js"></script>
  <script src="<?php echo ASSET_URL; ?>/js/ang/plunker.js"></script>
  <script src="<?php echo ASSET_URL; ?>/js/ang/app.js"></script>

  <link href="//cdnjs.cloudflare.com/ajax/libs/foundation/5.2.0/css/foundation.min.css" rel="stylesheet"/>
  <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="<?php echo ASSET_URL; ?>/css/rainbow.css"/>
  <link rel="stylesheet" href="<?php echo ASSET_URL; ?>/css/demo.css"/>
  <link rel="author" href="https://github.com/pineconellc/angular-foundation/graphs/contributors">
</head>
<body class="ng-cloak" ng-controller="MainCtrl">
<div class="fixed">
  <top-bar scrolltop="false">
    <ul class="title-area">
      <li class="name">
        <h1><a href="#">Angular Foundation</a></h1>
      </li>
      <li toggle-top-bar class="menu-icon"><a href="#">Menu</a></li>
    </ul>

    <top-bar-section>
      <ul class="right">
        <li><a href="#getting_started">Getting started</a></li>
        <li has-dropdown>
          <a href="#">Directives</a>
          <ul id="directives-list" top-bar-dropdown>
            <li><a href="#accordion">Accordion</a></li><li><a href="#alert">Alert</a></li><li><a href="#buttons">Buttons</a></li><li><a href="#dropdownToggle">Dropdown Toggle</a></li><li><a href="#interchange">Interchange</a></li><li><a href="#modal">Modal</a></li><li><a href="#offcanvas">Offcanvas</a></li><li><a href="#pagination">Pagination</a></li><li><a href="#popover">Popover</a></li><li><a href="#progressbar">Progressbar</a></li><li><a href="#rating">Rating</a></li><li><a href="#tabs">Tabs</a></li><li><a href="#tooltip">Tooltip</a></li><li><a href="#topbar">Topbar</a></li><li><a href="#tour">Tour</a></li><li><a href="#typeahead">Typeahead</a></li>
          </ul>
        </li>
        <li><a href="#animations">Animations</a></li>
      </ul>
    </top-bar-section>
  </top-bar>
</div>
<div class="header-placeholder"></div>
<div role="main">
  <header class="bs-header text-center" id="overview">
    <figure>
      <img src="<?php echo ASSET_URL; ?>/logo.png" class="logo" />
    </figure>
    <div class="container">
      <div class="row">
        <div class="columns large-12 medium-11 small-11 small-centered">

          <h1>Angular Foundation</h1>
          <h3>With love, from <a href="http://github.com/pineconellc/">Pinecone</a></h3>
          <hr>
          <p>
            <a class="button radius large" href="https://github.com/pineconellc/angular-foundation/tree/gh-pages"><i class="fa fa-download"></i> Download</a>
            <a class="button radius large" href="https://github.com/pineconellc/angular-foundation"><i class="fa fa-github"></i> Contribute</a>
          </p>
        </div>
      </div>
    </div>
  </header>
  <div class="container">
    <div class="row">
      <div class="columns border large-12 medium-11 small-11 small-centered">
        <section id="getting_started">
          <div class="page-header">
            <h1>Getting started</h1>
          </div>
          <h3>Dependencies</h3>
          <p>
            This repository contains a set of <strong>native AngularJS directives</strong> based on
            Foundation's markup and CSS. As a result no dependency on
            jQuery or Foundation's
            JavaScript is required. The <strong>only required dependencies</strong> are:
          </p>
          <ul>
            <li><a href="http://angularjs.org" target="_blank">AngularJS</a> (requires AngularJS 1.2.x, tested with 1.2.15)</li>
            <li><a href="http://foundation.zurb.com"
              target="_blank">Foundation CSS</a> (tested with version 5.2.0).
              This version of the library (0.3.1) works only with
              Foundation CSS in version 5.x.
            </li>
          </ul>
          <h3>Files to download</h3>
          <p>
            Build files for all directives are distributed in several flavours: minified for production usage, un-minified
            for development, with or without templates. All the options are described and can be
            <a href="https://github.com/pineconellc/angular-foundation/tree/gh-pages">downloaded from here</a>.
          </p>
          <h3>Installation</h3>
          <p>As soon as you've got all the files downloaded and included in your page you just need to declare
             a dependency on the <code>mm.foundation</code> <a href="http://docs.angularjs.org/guide/module">module</a>:<br>
             <pre><code>angular.module('myModule', ['mm.foundation']);</code></pre>
          </p>
          <p>You can fork one of the plunkers from this page to see a working example of what is described here.</p>
        </section>
        
          <section class="demo" id="accordion">
            <div class="page-header">
              <h1>Accordion<small>
                (<a target="_blank" href="https://github.com/pineconellc/angular-foundation/tree/master/src/accordion">mm.foundation.accordion</a>)
              </small></h1>
            </div>
            <div class="row">
              <div class="columns medium-6 show-grid">
                <div ng-controller="AccordionDemoCtrl">
  <label class="checkbox">
    <input type="checkbox" ng-model="oneAtATime">
    Open only one at a time
  </label>

  <accordion close-others="oneAtATime">
    <accordion-group heading="Static Header, initially expanded" is-open="true">
      This content is straight in the template.
    </accordion-group>
    <accordion-group heading="@{{group.title}}" ng-repeat="group in groups">
      @{{group.content}}
    </accordion-group>
    <accordion-group heading="Dynamic Body Content">
      <p>The body of the accordion group grows to fit the contents</p>
        <button class="button small" ng-click="addItem()">Add Item</button>
        <div ng-repeat="item in items">@{{item}}</div>
    </accordion-group>
    <accordion-group is-open="isopen">
        <accordion-heading>
            I can have markup, too! <i class="right" ng-class="{'fa fa-chevron-down': isopen, 'fa fa-chevron-right': !isopen}"></i>
        </accordion-heading>
        This is just some content to illustrate fancy headings.
    </accordion-group>
  </accordion>
</div>

              </div>
              <div class="columns medium-6">
                <p>The <strong>accordion directive</strong> builds on top of the collapse directive to provide a list of items, with collapsible bodies that are collapsed or expanded by clicking on the item's header.</p>

<p>We can control whether expanding an item will cause the other items to close, using the <code>close-others</code> attribute on accordion.</p>

<p>The body of each accordion group is transcluded in to the body of the collapsible element.</p>
              </div>
            </div>
            <hr>
            <div class="row code">
              <div class="columns medium-12" ng-controller="PlunkerCtrl">
                <div class="right">
                  <button class="button secondary" id="plunk-btn" ng-click="edit('1.2.15', '5.2.0', '0.3.1', 'accordion')"><i class="fa fa-edit"></i> Edit in plunker</button>
                </div>
                <tabset>
                  <tab heading="Markup">
                    <div plunker-content="markup">
                      <pre ng-non-bindable><code data-language="html">&lt;div ng-controller=&quot;AccordionDemoCtrl&quot;&gt;
  &lt;label class=&quot;checkbox&quot;&gt;
    &lt;input type=&quot;checkbox&quot; ng-model=&quot;oneAtATime&quot;&gt;
    Open only one at a time
  &lt;/label&gt;

  &lt;accordion close-others=&quot;oneAtATime&quot;&gt;
    &lt;accordion-group heading=&quot;Static Header, initially expanded&quot; is-open=&quot;true&quot;&gt;
      This content is straight in the template.
    &lt;/accordion-group&gt;
    &lt;accordion-group heading=&quot;@{{group.title}}&quot; ng-repeat=&quot;group in groups&quot;&gt;
      @{{group.content}}
    &lt;/accordion-group&gt;
    &lt;accordion-group heading=&quot;Dynamic Body Content&quot;&gt;
      &lt;p&gt;The body of the accordion group grows to fit the contents&lt;/p&gt;
        &lt;button class=&quot;button small&quot; ng-click=&quot;addItem()&quot;&gt;Add Item&lt;/button&gt;
        &lt;div ng-repeat=&quot;item in items&quot;&gt;@{{item}}&lt;/div&gt;
    &lt;/accordion-group&gt;
    &lt;accordion-group is-open=&quot;isopen&quot;&gt;
        &lt;accordion-heading&gt;
            I can have markup, too! &lt;i class=&quot;right&quot; ng-class=&quot;{&#x27;fa fa-chevron-down&#x27;: isopen, &#x27;fa fa-chevron-right&#x27;: !isopen}&quot;&gt;&lt;/i&gt;
        &lt;/accordion-heading&gt;
        This is just some content to illustrate fancy headings.
    &lt;/accordion-group&gt;
  &lt;/accordion&gt;
&lt;/div&gt;
</code></pre>
                    </div>
                  </tab>
                  <tab heading="JavaScript">
                    <div plunker-content="javascript">
                      <pre ng-non-bindable><code data-language="javascript">function AccordionDemoCtrl($scope) {
  $scope.oneAtATime = true;

  $scope.groups = [
    {
      title: &quot;Dynamic Group Header - 1&quot;,
      content: &quot;Dynamic Group Body - 1&quot;
    },
    {
      title: &quot;Dynamic Group Header - 2&quot;,
      content: &quot;Dynamic Group Body - 2&quot;
    }
  ];

  $scope.items = [&#x27;Item 1&#x27;, &#x27;Item 2&#x27;, &#x27;Item 3&#x27;];

  $scope.addItem = function() {
    var newItemNo = $scope.items.length + 1;
    $scope.items.push(&#x27;Item &#x27; + newItemNo);
  };
}
</code></pre>
                    </div>
                  </tab>
                </tabset>
              </div>
            </div>
          </section>
          <script>function AccordionDemoCtrl($scope) {
  $scope.oneAtATime = true;

  $scope.groups = [
    {
      title: "Dynamic Group Header - 1",
      content: "Dynamic Group Body - 1"
    },
    {
      title: "Dynamic Group Header - 2",
      content: "Dynamic Group Body - 2"
    }
  ];

  $scope.items = ['Item 1', 'Item 2', 'Item 3'];

  $scope.addItem = function() {
    var newItemNo = $scope.items.length + 1;
    $scope.items.push('Item ' + newItemNo);
  };
}
</script>
        
          <section class="demo" id="alert">
            <div class="page-header">
              <h1>Alert<small>
                (<a target="_blank" href="https://github.com/pineconellc/angular-foundation/tree/master/src/alert">mm.foundation.alert</a>)
              </small></h1>
            </div>
            <div class="row">
              <div class="columns medium-6 show-grid">
                <div ng-controller="AlertDemoCtrl">
  <alert ng-repeat="alert in alerts" type="alert.type" close="closeAlert($index)">@{{alert.msg}}</alert>
  <button class='button' ng-click="addAlert()">Add Alert</button>
</div>

              </div>
              <div class="columns medium-6">
                <p>Alert is an AngularJS-version of Foundation's alert.</p>

<p>This directive can be used to generate alerts from the dynamic model data (using the ng-repeat directive);</p>

<p>The presence of the "close" attribute determines if a close button is displayed</p>
              </div>
            </div>
            <hr>
            <div class="row code">
              <div class="columns medium-12" ng-controller="PlunkerCtrl">
                <div class="right">
                  <button class="button secondary" id="plunk-btn" ng-click="edit('1.2.15', '5.2.0', '0.3.1', 'alert')"><i class="fa fa-edit"></i> Edit in plunker</button>
                </div>
                <tabset>
                  <tab heading="Markup">
                    <div plunker-content="markup">
                      <pre ng-non-bindable><code data-language="html">&lt;div ng-controller=&quot;AlertDemoCtrl&quot;&gt;
  &lt;alert ng-repeat=&quot;alert in alerts&quot; type=&quot;alert.type&quot; close=&quot;closeAlert($index)&quot;&gt;@{{alert.msg}}&lt;/alert&gt;
  &lt;button class=&#x27;button&#x27; ng-click=&quot;addAlert()&quot;&gt;Add Alert&lt;/button&gt;
&lt;/div&gt;
</code></pre>
                    </div>
                  </tab>
                  <tab heading="JavaScript">
                    <div plunker-content="javascript">
                      <pre ng-non-bindable><code data-language="javascript">function AlertDemoCtrl($scope) {
  $scope.alerts = [
    { type: &#x27;danger&#x27;, msg: &#x27;Oh snap! Change a few things up and try submitting again.&#x27; },
    { type: &#x27;success round&#x27;, msg: &#x27;Well done! You successfully read this important alert message.&#x27; }
  ];

  $scope.addAlert = function() {
    $scope.alerts.push({msg: &quot;Another alert!&quot;});
  };

  $scope.closeAlert = function(index) {
    $scope.alerts.splice(index, 1);
  };

}
</code></pre>
                    </div>
                  </tab>
                </tabset>
              </div>
            </div>
          </section>
          <script>function AlertDemoCtrl($scope) {
  $scope.alerts = [
    { type: 'danger', msg: 'Oh snap! Change a few things up and try submitting again.' },
    { type: 'success round', msg: 'Well done! You successfully read this important alert message.' }
  ];

  $scope.addAlert = function() {
    $scope.alerts.push({msg: "Another alert!"});
  };

  $scope.closeAlert = function(index) {
    $scope.alerts.splice(index, 1);
  };

}
</script>
        
          <section class="demo" id="buttons">
            <div class="page-header">
              <h1>Buttons<small>
                (<a target="_blank" href="https://github.com/pineconellc/angular-foundation/tree/master/src/buttons">mm.foundation.buttons</a>)
              </small></h1>
            </div>
            <div class="row">
              <div class="columns medium-6 show-grid">
                <div ng-controller="ButtonsCtrl">
    <h4>Single toggle</h4>
    <pre>@{{singleModel}}</pre>
    <button type="button" class="button" ng-model="singleModel" btn-checkbox btn-checkbox-true="1" btn-checkbox-false="0">
        Single Toggle
    </button>
    <h4>Checkbox</h4>
    <pre>@{{checkModel}}</pre>
    <div class="button-group">
        <button type="button" class="button" ng-model="checkModel.left" btn-checkbox>Left</button>
        <button type="button" class="button" ng-model="checkModel.middle" btn-checkbox>Middle</button>
        <button type="button" class="button" ng-model="checkModel.right" btn-checkbox>Right</button>
    </div>
    <h4>Radio</h4>
    <pre>@{{radioModel}}</pre>
    <div class="button-group">
        <button type="button" class="button" ng-model="radioModel" btn-radio="'Left'">Left</button>
        <button type="button" class="button" ng-model="radioModel" btn-radio="'Middle'">Middle</button>
        <button type="button" class="button" ng-model="radioModel" btn-radio="'Right'">Right</button>
    </div>
</div>

              </div>
              <div class="columns medium-6">
                <p>There are 2 directives that can make a group of buttons to behave like a set of checkboxes or radio buttons.</p>
              </div>
            </div>
            <hr>
            <div class="row code">
              <div class="columns medium-12" ng-controller="PlunkerCtrl">
                <div class="right">
                  <button class="button secondary" id="plunk-btn" ng-click="edit('1.2.15', '5.2.0', '0.3.1', 'buttons')"><i class="fa fa-edit"></i> Edit in plunker</button>
                </div>
                <tabset>
                  <tab heading="Markup">
                    <div plunker-content="markup">
                      <pre ng-non-bindable><code data-language="html">&lt;div ng-controller=&quot;ButtonsCtrl&quot;&gt;
    &lt;h4&gt;Single toggle&lt;/h4&gt;
    &lt;pre&gt;@{{singleModel}}&lt;/pre&gt;
    &lt;button type=&quot;button&quot; class=&quot;button&quot; ng-model=&quot;singleModel&quot; btn-checkbox btn-checkbox-true=&quot;1&quot; btn-checkbox-false=&quot;0&quot;&gt;
        Single Toggle
    &lt;/button&gt;
    &lt;h4&gt;Checkbox&lt;/h4&gt;
    &lt;pre&gt;@{{checkModel}}&lt;/pre&gt;
    &lt;div class=&quot;button-group&quot;&gt;
        &lt;button type=&quot;button&quot; class=&quot;button&quot; ng-model=&quot;checkModel.left&quot; btn-checkbox&gt;Left&lt;/button&gt;
        &lt;button type=&quot;button&quot; class=&quot;button&quot; ng-model=&quot;checkModel.middle&quot; btn-checkbox&gt;Middle&lt;/button&gt;
        &lt;button type=&quot;button&quot; class=&quot;button&quot; ng-model=&quot;checkModel.right&quot; btn-checkbox&gt;Right&lt;/button&gt;
    &lt;/div&gt;
    &lt;h4&gt;Radio&lt;/h4&gt;
    &lt;pre&gt;@{{radioModel}}&lt;/pre&gt;
    &lt;div class=&quot;button-group&quot;&gt;
        &lt;button type=&quot;button&quot; class=&quot;button&quot; ng-model=&quot;radioModel&quot; btn-radio=&quot;&#x27;Left&#x27;&quot;&gt;Left&lt;/button&gt;
        &lt;button type=&quot;button&quot; class=&quot;button&quot; ng-model=&quot;radioModel&quot; btn-radio=&quot;&#x27;Middle&#x27;&quot;&gt;Middle&lt;/button&gt;
        &lt;button type=&quot;button&quot; class=&quot;button&quot; ng-model=&quot;radioModel&quot; btn-radio=&quot;&#x27;Right&#x27;&quot;&gt;Right&lt;/button&gt;
    &lt;/div&gt;
&lt;/div&gt;
</code></pre>
                    </div>
                  </tab>
                  <tab heading="JavaScript">
                    <div plunker-content="javascript">
                      <pre ng-non-bindable><code data-language="javascript">var ButtonsCtrl = function ($scope) {

  $scope.singleModel = 1;

  $scope.radioModel = &#x27;Middle&#x27;;

  $scope.checkModel = {
    left: false,
    middle: true,
    right: false
  };
};</code></pre>
                    </div>
                  </tab>
                </tabset>
              </div>
            </div>
          </section>
          <script>var ButtonsCtrl = function ($scope) {

  $scope.singleModel = 1;

  $scope.radioModel = 'Middle';

  $scope.checkModel = {
    left: false,
    middle: true,
    right: false
  };
};</script>
        
          <section class="demo" id="dropdownToggle">
            <div class="page-header">
              <h1>Dropdown Toggle<small>
                (<a target="_blank" href="https://github.com/pineconellc/angular-foundation/tree/master/src/dropdownToggle">mm.foundation.dropdownToggle</a>)
              </small></h1>
            </div>
            <div class="row">
              <div class="columns medium-6 show-grid">
                <div ng-controller="DropdownCtrl">
  <p>
    <a dropdown-toggle="#dropdown-example-1">Click me for a dropdown, yo!</a>
  </p>
  <ul id="dropdown-example-1" class="f-dropdown">
    <li ng-repeat="choice in items">
      <a>@{{choice}}</a>
    </li>
  </ul>

  <a class="button dropdown" dropdown-toggle="#dropdown-example-2">Dropdowns can also have links!</a>
  <ul id="dropdown-example-2" class="f-dropdown">
    <li ng-repeat="(label, url) in linkItems">
      <a href="@{{url}}" target="_blank">@{{label}}</a>
    </li>
  </ul>

  <a class="button split">
    Split Button
    <span dropdown-toggle="#dropdown-example-3"></span>
  </a>
  <ul id="dropdown-example-3" class="f-dropdown">
    <li ng-repeat="choice in items">
      <a>@{{choice}}</a>
    </li>
  </ul>
</div>

              </div>
              <div class="columns medium-6">
                <p>DropdownToggle is a simple directive which will toggle a dropdown link on click.  Simply put it on the toggler-element, and it will find the target element and toggle it when the element matching the value of the <code>dropdown-toggle</code> attribute is clicked.</p>
              </div>
            </div>
            <hr>
            <div class="row code">
              <div class="columns medium-12" ng-controller="PlunkerCtrl">
                <div class="right">
                  <button class="button secondary" id="plunk-btn" ng-click="edit('1.2.15', '5.2.0', '0.3.1', 'dropdownToggle')"><i class="fa fa-edit"></i> Edit in plunker</button>
                </div>
                <tabset>
                  <tab heading="Markup">
                    <div plunker-content="markup">
                      <pre ng-non-bindable><code data-language="html">&lt;div ng-controller=&quot;DropdownCtrl&quot;&gt;
  &lt;p&gt;
    &lt;a dropdown-toggle=&quot;#dropdown-example-1&quot;&gt;Click me for a dropdown, yo!&lt;/a&gt;
  &lt;/p&gt;
  &lt;ul id=&quot;dropdown-example-1&quot; class=&quot;f-dropdown&quot;&gt;
    &lt;li ng-repeat=&quot;choice in items&quot;&gt;
      &lt;a&gt;@{{choice}}&lt;/a&gt;
    &lt;/li&gt;
  &lt;/ul&gt;

  &lt;a class=&quot;button dropdown&quot; dropdown-toggle=&quot;#dropdown-example-2&quot;&gt;Dropdowns can also have links!&lt;/a&gt;
  &lt;ul id=&quot;dropdown-example-2&quot; class=&quot;f-dropdown&quot;&gt;
    &lt;li ng-repeat=&quot;(label, url) in linkItems&quot;&gt;
      &lt;a href=&quot;@{{url}}&quot; target=&quot;_blank&quot;&gt;@{{label}}&lt;/a&gt;
    &lt;/li&gt;
  &lt;/ul&gt;

  &lt;a class=&quot;button split&quot;&gt;
    Split Button
    &lt;span dropdown-toggle=&quot;#dropdown-example-3&quot;&gt;&lt;/span&gt;
  &lt;/a&gt;
  &lt;ul id=&quot;dropdown-example-3&quot; class=&quot;f-dropdown&quot;&gt;
    &lt;li ng-repeat=&quot;choice in items&quot;&gt;
      &lt;a&gt;@{{choice}}&lt;/a&gt;
    &lt;/li&gt;
  &lt;/ul&gt;
&lt;/div&gt;
</code></pre>
                    </div>
                  </tab>
                  <tab heading="JavaScript">
                    <div plunker-content="javascript">
                      <pre ng-non-bindable><code data-language="javascript">function DropdownCtrl($scope) {
  $scope.items = [
    &quot;The first choice!&quot;,
    &quot;And another choice for you.&quot;,
    &quot;but wait! A third!&quot;
  ];
  $scope.linkItems = {
    &quot;Google&quot;: &quot;http://google.com&quot;,
    &quot;AltaVista&quot;: &quot;http://altavista.com&quot;
  };
}
</code></pre>
                    </div>
                  </tab>
                </tabset>
              </div>
            </div>
          </section>
          <script>function DropdownCtrl($scope) {
  $scope.items = [
    "The first choice!",
    "And another choice for you.",
    "but wait! A third!"
  ];
  $scope.linkItems = {
    "Google": "http://google.com",
    "AltaVista": "http://altavista.com"
  };
}
</script>
        
          <section class="demo" id="interchange">
            <div class="page-header">
              <h1>Interchange<small>
                (<a target="_blank" href="https://github.com/pineconellc/angular-foundation/tree/master/src/interchange">mm.foundation.interchange</a>)
              </small></h1>
            </div>
            <div class="row">
              <div class="columns medium-6 show-grid">
                <img interchange="[<?php echo ASSET_URL; ?>/img/space-small.jpg, (small)],
                  [<?php echo ASSET_URL; ?>/img/space-medium.jpg, (medium)],
                  [<?php echo ASSET_URL; ?>/img/space-large.jpg, (large)]"
     src="<?php echo ASSET_URL; ?>/img/space-small.jpg">

<p class="panel">Resize the window to update the content</p>

              </div>
              <div class="columns medium-6">
                <p>Interchange uses media queries to dynamically load responsive content that is appropriate for different screen sizes.</p>

<p>You can use Interchange with different content types:</p>

<ul>
<li><em>HTML templates:</em> by linking a rule with html files to a <code>div</code> tag</li>
<li><em>Images:</em> through an interchange rule to an <code>img</code> tag</li>
<li><em>Background-images</em> through linking a rule with picture files to a <code>div</code> tag</li>
</ul>

<p>Custom named queries are available via the method <code>add</code> of the <code>interchangeQueriesManager</code> factory. You just need to provide the name and media type desired.</p>

<p>Like the original, <code>replace</code> events are available when an Interchange element switch to another media query.</p>

<p>For more information, check out <a href="http://foundation.zurb.com/docs/components/interchange.html">the docs for the original Interchange component</a>.</p>

<p><em>Images courtesy of the official ZURB Foundation documentation.</em></p>
              </div>
            </div>
            <hr>
            <div class="row code">
              <div class="columns medium-12" ng-controller="PlunkerCtrl">
                <div class="right">
                  <button class="button secondary" id="plunk-btn" ng-click="edit('1.2.15', '5.2.0', '0.3.1', 'interchange')"><i class="fa fa-edit"></i> Edit in plunker</button>
                </div>
                <tabset>
                  <tab heading="Markup">
                    <div plunker-content="markup">
                      <pre ng-non-bindable><code data-language="html">&lt;img interchange=&quot;[<?php echo ASSET_URL; ?>/img/space-small.jpg, (small)],
                  [<?php echo ASSET_URL; ?>/img/space-medium.jpg, (medium)],
                  [<?php echo ASSET_URL; ?>/img/space-large.jpg, (large)]&quot;
     src=&quot;<?php echo ASSET_URL; ?>/img/space-small.jpg&quot;&gt;

&lt;p class=&quot;panel&quot;&gt;Resize the window to update the content&lt;/p&gt;
</code></pre>
                    </div>
                  </tab>
                  <tab heading="JavaScript">
                    <div plunker-content="javascript">
                      <pre ng-non-bindable><code data-language="javascript">// No controller required</code></pre>
                    </div>
                  </tab>
                </tabset>
              </div>
            </div>
          </section>
          <script>// No controller required</script>
        
          <section class="demo" id="modal">
            <div class="page-header">
              <h1>Modal<small>
                (<a target="_blank" href="https://github.com/pineconellc/angular-foundation/tree/master/src/modal">mm.foundation.modal</a>)
              </small></h1>
            </div>
            <div class="row">
              <div class="columns medium-6 show-grid">
                <div ng-controller="ModalDemoCtrl">
  <script type="text/ng-template" id="myModalContent.html">
    <h3>I'm a modal!</h3>
    <ul>
      <li ng-repeat="item in items">
        <a ng-click="selected.item = item">@{{ item }}</a>
      </li>
    </ul>
    <p>Selected: <b>@{{ selected.item }}</b></p>
    <button class="button" ng-click="ok()">OK</button>
    <a class="close-reveal-modal" ng-click="cancel()">&#215;</a>
  </script>

  <button class="button" ng-click="open()">Open me!</button>
  <div ng-show="selected">Selection from a modal: @{{ selected }}</div>
</div>

              </div>
              <div class="columns medium-6">
                <p><code>$modal</code> is a service to quickly create AngularJS-powered modal windows. It is the equivalent of the <a href="http://foundation.zurb.com/docs/components/reveal.html">Foundation Reveal</a> component.
Creating custom modals is straightforward: create a partial view, its controller and reference them when using the service.</p>

<p>The <code>$modal</code> service has only one method: <code>open(options)</code> where available options are like follows:</p>

<ul>
<li><code>templateUrl</code> - a path to a template representing modal's content</li>
<li><code>template</code> - inline template representing the modal's content</li>
<li><code>scope</code> - a scope instance to be used for the modal's content (actually the <code>$modal</code> service is going to create a child scope of a provided scope). Defaults to <code>$rootScope</code></li>
<li><code>controller</code> - a controller for a modal instance - it can initialize scope used by modal. Accepts the "controller-as" syntax, and can be injected with <code>$modalInstance</code></li>
<li><code>resolve</code> - members that will be resolved and passed to the controller as locals; it is equivalent of the <code>resolve</code> property for AngularJS routes</li>
<li><code>backdrop</code> - controls presence of a backdrop. Allowed values: true (default), false (no backdrop), <code>'static'</code> - backdrop is present but modal window is not closed when clicking outside of the modal window.</li>
<li><code>keyboard</code> - indicates whether the dialog should be closable by hitting the ESC key, defaults to true</li>
<li><code>windowClass</code> - additional CSS class(es) to be added to a modal window template</li>
</ul>

<p>The <code>open</code> method returns a modal instance, an object with the following properties:</p>

<ul>
<li><code>close(result)</code> - a method that can be used to close a modal, passing a result</li>
<li><code>dismiss(reason)</code> - a method that can be used to dismiss a modal, passing a reason</li>
<li><code>result</code> - a promise that is resolved when a modal is closed and rejected when a modal is dismissed</li>
<li><code>opened</code> - a promise that is resolved when a modal gets opened after downloading content's template and resolving all variables</li>
</ul>

<p>In addition the scope associated with modal's content is augmented with 2 methods:
* <code>$close(result)</code>
* <code>$dismiss(reason)</code>
Those methods make it easy to close a modal window without a need to create a dedicated controller</p>
              </div>
            </div>
            <hr>
            <div class="row code">
              <div class="columns medium-12" ng-controller="PlunkerCtrl">
                <div class="right">
                  <button class="button secondary" id="plunk-btn" ng-click="edit('1.2.15', '5.2.0', '0.3.1', 'modal')"><i class="fa fa-edit"></i> Edit in plunker</button>
                </div>
                <tabset>
                  <tab heading="Markup">
                    <div plunker-content="markup">
                      <pre ng-non-bindable><code data-language="html">&lt;div ng-controller=&quot;ModalDemoCtrl&quot;&gt;
  &lt;script type=&quot;text/ng-template&quot; id=&quot;myModalContent.html&quot;&gt;
    &lt;h3&gt;I&#x27;m a modal!&lt;/h3&gt;
    &lt;ul&gt;
      &lt;li ng-repeat=&quot;item in items&quot;&gt;
        &lt;a ng-click=&quot;selected.item = item&quot;&gt;@{{ item }}&lt;/a&gt;
      &lt;/li&gt;
    &lt;/ul&gt;
    &lt;p&gt;Selected: &lt;b&gt;@{{ selected.item }}&lt;/b&gt;&lt;/p&gt;
    &lt;button class=&quot;button&quot; ng-click=&quot;ok()&quot;&gt;OK&lt;/button&gt;
    &lt;a class=&quot;close-reveal-modal&quot; ng-click=&quot;cancel()&quot;&gt;&amp;#215;&lt;/a&gt;
  &lt;/script&gt;

  &lt;button class=&quot;button&quot; ng-click=&quot;open()&quot;&gt;Open me!&lt;/button&gt;
  &lt;div ng-show=&quot;selected&quot;&gt;Selection from a modal: @{{ selected }}&lt;/div&gt;
&lt;/div&gt;
</code></pre>
                    </div>
                  </tab>
                  <tab heading="JavaScript">
                    <div plunker-content="javascript">
                      <pre ng-non-bindable><code data-language="javascript">var ModalDemoCtrl = function ($scope, $modal, $log) {

  $scope.items = [&#x27;item1&#x27;, &#x27;item2&#x27;, &#x27;item3&#x27;];

  $scope.open = function () {

    var modalInstance = $modal.open({
      templateUrl: &#x27;myModalContent.html&#x27;,
      controller: ModalInstanceCtrl,
      resolve: {
        items: function () {
          return $scope.items;
        }
      }
    });

    modalInstance.result.then(function (selectedItem) {
      $scope.selected = selectedItem;
    }, function () {
      $log.info(&#x27;Modal dismissed at: &#x27; + new Date());
    });
  };
};

// Please note that $modalInstance represents a modal window (instance) dependency.
// It is not the same as the $modal service used above.

var ModalInstanceCtrl = function ($scope, $modalInstance, items) {

  $scope.items = items;
  $scope.selected = {
    item: $scope.items[0]
  };

  $scope.ok = function () {
    $modalInstance.close($scope.selected.item);
  };

  $scope.cancel = function () {
    $modalInstance.dismiss(&#x27;cancel&#x27;);
  };
};</code></pre>
                    </div>
                  </tab>
                </tabset>
              </div>
            </div>
          </section>
          <script>var ModalDemoCtrl = function ($scope, $modal, $log) {

  $scope.items = ['item1', 'item2', 'item3'];

  $scope.open = function () {

    var modalInstance = $modal.open({
      templateUrl: 'myModalContent.html',
      controller: ModalInstanceCtrl,
      resolve: {
        items: function () {
          return $scope.items;
        }
      }
    });

    modalInstance.result.then(function (selectedItem) {
      $scope.selected = selectedItem;
    }, function () {
      $log.info('Modal dismissed at: ' + new Date());
    });
  };
};

// Please note that $modalInstance represents a modal window (instance) dependency.
// It is not the same as the $modal service used above.

var ModalInstanceCtrl = function ($scope, $modalInstance, items) {

  $scope.items = items;
  $scope.selected = {
    item: $scope.items[0]
  };

  $scope.ok = function () {
    $modalInstance.close($scope.selected.item);
  };

  $scope.cancel = function () {
    $modalInstance.dismiss('cancel');
  };
};</script>
        
          <section class="demo" id="offcanvas">
            <div class="page-header">
              <h1>Offcanvas<small>
                (<a target="_blank" href="https://github.com/pineconellc/angular-foundation/tree/master/src/offcanvas">mm.foundation.offcanvas</a>)
              </small></h1>
            </div>
            <div class="row">
              <div class="columns medium-6 show-grid">
                <div class="off-canvas-wrap" ng-controller="OffCanvasDemoCtrl">
    <div class="inner-wrap">
        <nav class="tab-bar">
            <section class="left-small">
                <a class="left-off-canvas-toggle menu-icon" ><span></span></a>
            </section>

            <section class="middle tab-bar-section">
                <h1 class="title">OffCanvas</h1>
            </section>

            <section class="right-small">
                <a class="right-off-canvas-toggle menu-icon" ><span></span></a>
            </section>

        </nav>

        <aside class="left-off-canvas-menu">
            <ul class="off-canvas-list">
                <li><a href="#">Left Sidebar</a></li>
            </ul>
        </aside>
        <aside class="right-off-canvas-menu">
            <ul class="off-canvas-list">
                <li><a href="#">Right Sidebar</a></li>
            </ul>
        </aside>
        <section class="main-section">
            <div class="small-12 columns">
                <h1>How to use</h1>
                <p>Just use the standard layout for an offcanvas page as documented in the <a href="http://foundation.zurb.com/docs/components/offcanvas.html">foundation docs</a></p>
                <p>As long as you include mm.foundation.offcanvas it should simply work</p>
            </div>
        </section>

        <a class="exit-off-canvas"></a>
    </div>
</div>

              </div>
              <div class="columns medium-6">
                <p>A lightweight directive that provides the <a href="http://foundation.zurb.com/docs/components/offcanvas.html">Foundation Offcanvas</a> component.</p>

<p>There are no settings. You simply need to include the foundation off canvas CSS component in your page.</p>

<p>The off canvas module expects the use of several nested elements with the following classes:</p>

<ul>
<li><code>off-canvas-wrap</code>: The most outter page wrapper.</li>
<li><code>inner-wrap</code>: Second page wrapper nested directly inside off-canvas-wrap.</li>
<li><code>left-off-canvas-toggle</code>: Wraps the left off canvas menu.</li>
<li><code>right-off-canvas-toggle</code>: Wraps the right off canvas menu.</li>
<li><code>exit-off-canvas</code>: Occludes the main page content when an off canvas menu is visible. Hides the menu when clicked.</li>
<li><code>off-canvas-list</code>: Contains off canvas menu items. Hides the menu after a nested link is clicked.</li>
</ul>

<p>See the demo page for example on how to use this and see the <a href="http://foundation.zurb.com/docs/components/offcanvas.html">Foundation docs</a> for more details.</p>
              </div>
            </div>
            <hr>
            <div class="row code">
              <div class="columns medium-12" ng-controller="PlunkerCtrl">
                <div class="right">
                  <button class="button secondary" id="plunk-btn" ng-click="edit('1.2.15', '5.2.0', '0.3.1', 'offcanvas')"><i class="fa fa-edit"></i> Edit in plunker</button>
                </div>
                <tabset>
                  <tab heading="Markup">
                    <div plunker-content="markup">
                      <pre ng-non-bindable><code data-language="html">&lt;div class=&quot;off-canvas-wrap&quot; ng-controller=&quot;OffCanvasDemoCtrl&quot;&gt;
    &lt;div class=&quot;inner-wrap&quot;&gt;
        &lt;nav class=&quot;tab-bar&quot;&gt;
            &lt;section class=&quot;left-small&quot;&gt;
                &lt;a class=&quot;left-off-canvas-toggle menu-icon&quot; &gt;&lt;span&gt;&lt;/span&gt;&lt;/a&gt;
            &lt;/section&gt;

            &lt;section class=&quot;middle tab-bar-section&quot;&gt;
                &lt;h1 class=&quot;title&quot;&gt;OffCanvas&lt;/h1&gt;
            &lt;/section&gt;

            &lt;section class=&quot;right-small&quot;&gt;
                &lt;a class=&quot;right-off-canvas-toggle menu-icon&quot; &gt;&lt;span&gt;&lt;/span&gt;&lt;/a&gt;
            &lt;/section&gt;

        &lt;/nav&gt;

        &lt;aside class=&quot;left-off-canvas-menu&quot;&gt;
            &lt;ul class=&quot;off-canvas-list&quot;&gt;
                &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Left Sidebar&lt;/a&gt;&lt;/li&gt;
            &lt;/ul&gt;
        &lt;/aside&gt;
        &lt;aside class=&quot;right-off-canvas-menu&quot;&gt;
            &lt;ul class=&quot;off-canvas-list&quot;&gt;
                &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Right Sidebar&lt;/a&gt;&lt;/li&gt;
            &lt;/ul&gt;
        &lt;/aside&gt;
        &lt;section class=&quot;main-section&quot;&gt;
            &lt;div class=&quot;small-12 columns&quot;&gt;
                &lt;h1&gt;How to use&lt;/h1&gt;
                &lt;p&gt;Just use the standard layout for an offcanvas page as documented in the &lt;a href=&quot;http://foundation.zurb.com/docs/components/offcanvas.html&quot;&gt;foundation docs&lt;/a&gt;&lt;/p&gt;
                &lt;p&gt;As long as you include mm.foundation.offcanvas it should simply work&lt;/p&gt;
            &lt;/div&gt;
        &lt;/section&gt;

        &lt;a class=&quot;exit-off-canvas&quot;&gt;&lt;/a&gt;
    &lt;/div&gt;
&lt;/div&gt;
</code></pre>
                    </div>
                  </tab>
                  <tab heading="JavaScript">
                    <div plunker-content="javascript">
                      <pre ng-non-bindable><code data-language="javascript">var OffCanvasDemoCtrl = function ($scope) {

};
</code></pre>
                    </div>
                  </tab>
                </tabset>
              </div>
            </div>
          </section>
          <script>var OffCanvasDemoCtrl = function ($scope) {

};
</script>
        
          <section class="demo" id="pagination">
            <div class="page-header">
              <h1>Pagination<small>
                (<a target="_blank" href="https://github.com/pineconellc/angular-foundation/tree/master/src/pagination">mm.foundation.pagination</a>)
              </small></h1>
            </div>
            <div class="row">
              <div class="columns medium-6 show-grid">
                <div ng-controller="PaginationDemoCtrl">
    <h4>Default</h4>
    <pagination total-items="totalItems" page="currentPage"></pagination>
    <pagination boundary-links="true" total-items="totalItems" page="currentPage" class="pagination-sm" previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;"></pagination>
    <pagination direction-links="false" boundary-links="true" total-items="totalItems" page="currentPage"></pagination>
    <pagination direction-links="false" total-items="totalItems" page="currentPage" num-pages="smallnumPages"></pagination>
    <pre>The selected page no: @{{currentPage}}</pre>
    <button class="button secondary" ng-click="setPage(3)">Set current page to: 3</button>

    <hr />
    <h4>Pager</h4>
    <pager total-items="totalItems" page="currentPage"></pager>

    <hr />
    <h4>Limit the maximum visible buttons</h4>
    <pagination total-items="bigTotalItems" page="bigCurrentPage" max-size="maxSize" class="pagination-sm" boundary-links="true"></pagination>
    <pagination total-items="bigTotalItems" page="bigCurrentPage" max-size="maxSize" class="pagination-sm" boundary-links="true" rotate="false" num-pages="numPages"></pagination>
    <pre>Page: @{{bigCurrentPage}} / @{{numPages}}</pre>
</div>

              </div>
              <div class="columns medium-6">
                <p>A lightweight pagination directive that is focused on ... providing pagination &amp; will take care of visualising a pagination bar and enable / disable buttons correctly!</p>

<h3>Pagination Settings</h3>

<p>Settings can be provided as attributes in the <code>&lt;pagination&gt;</code> or globally configured through the <code>paginationConfig</code>.</p>

<ul>
<li><p><code>page</code> <i class="fa fa-eye"></i>
 :
 Current page number. First page is 1.</p></li>
<li><p><code>total-items</code> <i class="fa fa-eye"></i>
 :
 Total number of items in all pages.</p></li>
<li><p><code>items-per-page</code> <i class="fa fa-eye"></i>
 <em>(Defaults: 10)</em> :
 Maximum number of items per page. A value less than one indicates all items on one page.</p></li>
<li><p><code>max-size</code> <i class="fa fa-eye"></i>
 <em>(Defaults: null)</em> :
 Limit number for pagination size.</p></li>
<li><p><code>num-pages</code> <small class="badge">readonly</small>
 <em>(Defaults: angular.noop)</em> :
 An optional expression assigned the total number of pages to display.</p></li>
<li><p><code>rotate</code>
 <em>(Defaults: true)</em> :
 Whether to keep current page in the middle of the visible ones.</p></li>
<li><p><code>on-select-page (page)</code>
 <em>(Default: null)</em> :
 An optional expression called when a page is selected having the page number as argument.</p></li>
<li><p><code>direction-links</code>
 <em>(Default: true)</em> :
 Whether to display Previous / Next buttons.</p></li>
<li><p><code>previous-text</code>
 <em>(Default: 'Previous')</em> :
 Text for Previous button.</p></li>
<li><p><code>next-text</code>
 <em>(Default: 'Next')</em> :
 Text for Next button.</p></li>
<li><p><code>boundary-links</code>
 <em>(Default: false)</em> :
 Whether to display First / Last buttons.</p></li>
<li><p><code>first-text</code>
 <em>(Default: 'First')</em> :
 Text for First button.</p></li>
<li><p><code>last-text</code>
 <em>(Default: 'Last')</em> :
 Text for Last button.</p></li>
</ul>

<h3>Pager Settings</h3>

<p>Settings can be provided as attributes in the <code>&lt;pager&gt;</code> or globally configured through the <code>pagerConfig</code>. <br />
For <code>page</code>, <code>total-items</code>, <code>items-per-page</code>, <code>num-pages</code> and <code>on-select-page (page)</code> see pagination settings. Other settings are:</p>

<ul>
<li><p><code>align</code>
 <em>(Default: true)</em> :
 Whether to align each link to the sides.</p></li>
<li><p><code>previous-text</code>
 <em>(Default: '« Previous')</em> :
 Text for Previous button.</p></li>
<li><p><code>next-text</code>
 <em>(Default: 'Next »')</em> :
 Text for Next button.</p></li>
</ul>
              </div>
            </div>
            <hr>
            <div class="row code">
              <div class="columns medium-12" ng-controller="PlunkerCtrl">
                <div class="right">
                  <button class="button secondary" id="plunk-btn" ng-click="edit('1.2.15', '5.2.0', '0.3.1', 'pagination')"><i class="fa fa-edit"></i> Edit in plunker</button>
                </div>
                <tabset>
                  <tab heading="Markup">
                    <div plunker-content="markup">
                      <pre ng-non-bindable><code data-language="html">&lt;div ng-controller=&quot;PaginationDemoCtrl&quot;&gt;
    &lt;h4&gt;Default&lt;/h4&gt;
    &lt;pagination total-items=&quot;totalItems&quot; page=&quot;currentPage&quot;&gt;&lt;/pagination&gt;
    &lt;pagination boundary-links=&quot;true&quot; total-items=&quot;totalItems&quot; page=&quot;currentPage&quot; class=&quot;pagination-sm&quot; previous-text=&quot;&amp;lsaquo;&quot; next-text=&quot;&amp;rsaquo;&quot; first-text=&quot;&amp;laquo;&quot; last-text=&quot;&amp;raquo;&quot;&gt;&lt;/pagination&gt;
    &lt;pagination direction-links=&quot;false&quot; boundary-links=&quot;true&quot; total-items=&quot;totalItems&quot; page=&quot;currentPage&quot;&gt;&lt;/pagination&gt;
    &lt;pagination direction-links=&quot;false&quot; total-items=&quot;totalItems&quot; page=&quot;currentPage&quot; num-pages=&quot;smallnumPages&quot;&gt;&lt;/pagination&gt;
    &lt;pre&gt;The selected page no: @{{currentPage}}&lt;/pre&gt;
    &lt;button class=&quot;button secondary&quot; ng-click=&quot;setPage(3)&quot;&gt;Set current page to: 3&lt;/button&gt;

    &lt;hr /&gt;
    &lt;h4&gt;Pager&lt;/h4&gt;
    &lt;pager total-items=&quot;totalItems&quot; page=&quot;currentPage&quot;&gt;&lt;/pager&gt;

    &lt;hr /&gt;
    &lt;h4&gt;Limit the maximum visible buttons&lt;/h4&gt;
    &lt;pagination total-items=&quot;bigTotalItems&quot; page=&quot;bigCurrentPage&quot; max-size=&quot;maxSize&quot; class=&quot;pagination-sm&quot; boundary-links=&quot;true&quot;&gt;&lt;/pagination&gt;
    &lt;pagination total-items=&quot;bigTotalItems&quot; page=&quot;bigCurrentPage&quot; max-size=&quot;maxSize&quot; class=&quot;pagination-sm&quot; boundary-links=&quot;true&quot; rotate=&quot;false&quot; num-pages=&quot;numPages&quot;&gt;&lt;/pagination&gt;
    &lt;pre&gt;Page: @{{bigCurrentPage}} / @{{numPages}}&lt;/pre&gt;
&lt;/div&gt;
</code></pre>
                    </div>
                  </tab>
                  <tab heading="JavaScript">
                    <div plunker-content="javascript">
                      <pre ng-non-bindable><code data-language="javascript">var PaginationDemoCtrl = function ($scope) {
  $scope.totalItems = 64;
  $scope.currentPage = 4;
  $scope.maxSize = 5;
  
  $scope.setPage = function (pageNo) {
    $scope.currentPage = pageNo;
  };

  $scope.bigTotalItems = 175;
  $scope.bigCurrentPage = 1;
};
</code></pre>
                    </div>
                  </tab>
                </tabset>
              </div>
            </div>
          </section>
          <script>var PaginationDemoCtrl = function ($scope) {
  $scope.totalItems = 64;
  $scope.currentPage = 4;
  $scope.maxSize = 5;
  
  $scope.setPage = function (pageNo) {
    $scope.currentPage = pageNo;
  };

  $scope.bigTotalItems = 175;
  $scope.bigCurrentPage = 1;
};
</script>
        
          <section class="demo" id="popover">
            <div class="page-header">
              <h1>Popover<small>
                (<a target="_blank" href="https://github.com/pineconellc/angular-foundation/tree/master/src/popover">mm.foundation.popover</a>)
              </small></h1>
            </div>
            <div class="row">
              <div class="columns medium-6 show-grid">
                <div ng-controller="PopoverDemoCtrl">
    <h4>Dynamic</h4>
    <div class="form-group">
      <label>Popup Text:</label>
      <input type="text" ng-model="dynamicPopover" class="form-control">
    </div>
    <div class="form-group">
      <label>Popup Title:</label>
      <input type="text" ng-model="dynamicPopoverTitle" class="form-control">
    </div>
    <button popover="@{{dynamicPopover}}"
      popover-title="@{{dynamicPopoverTitle}}" class="button">Dynamic Popover</button>
    
    <hr />
    <h4>Positional</h4>
    <button popover-placement="top" popover="On the Top!" class="button">Top</button>
    <button popover-placement="left" popover="On the Left!" class="button">Left</button>
    <button popover-placement="right" popover="On the Right!" class="button">Right</button>
    <button popover-placement="bottom" popover="On the Bottom!" class="button">Bottom</button>
    
    <hr />
    <h4>Triggers</h4>
    <p>
      <button popover="I appeared on mouse enter!" popover-trigger="mouseenter" class="button">Mouseenter</button>
    </p>
    <input type="text" value="Click me!" popover="I appeared on focus! Click away and I'll vanish..."  popover-trigger="focus" class="form-control">

    <hr />
    <h4>Other</h4>
    <button Popover-animation="true" popover="I fade in and out!" class="button">fading</button>
    <button popover="I have a title!" popover-title="The title." class="button">title</button>
</div>

              </div>
              <div class="columns medium-6">
                <p>A lightweight, extensible directive for fancy popover creation. The popover
directive supports multiple placements, optional transition animation, and more.</p>

<p>Like the Bootstrap jQuery plugin, the popover <strong>requires</strong> the tooltip
module.</p>

<p>The popover directives provides several optional attributes to control how it
will display:</p>

<ul>
<li><code>popover-title</code>: A string to display as a fancy title.</li>
<li><code>popover-placement</code>: Where to place it? Defaults to "top", but also accepts
"bottom", "left", "right".</li>
<li><code>popover-animation</code>: Should it fade in and out? Defaults to "true".</li>
<li><code>popover-popup-delay</code>: For how long should the user have to have the mouse
over the element before the popover shows (in milliseconds)? Defaults to 0.</li>
<li><code>popover-trigger</code>: What should trigger the show of the popover? See the
<code>tooltip</code> directive for supported values.</li>
<li><code>popover-append-to-body</code>: Should the tooltip be appended to <code>$body</code> instead of
the parent element?</li>
</ul>

<p>The popover directives require the <code>$position</code> service.</p>

<p>The popover directive also supports various default configurations through the
$tooltipProvider. See the <a href="#tooltip">tooltip</a> section for more information.</p>
              </div>
            </div>
            <hr>
            <div class="row code">
              <div class="columns medium-12" ng-controller="PlunkerCtrl">
                <div class="right">
                  <button class="button secondary" id="plunk-btn" ng-click="edit('1.2.15', '5.2.0', '0.3.1', 'popover')"><i class="fa fa-edit"></i> Edit in plunker</button>
                </div>
                <tabset>
                  <tab heading="Markup">
                    <div plunker-content="markup">
                      <pre ng-non-bindable><code data-language="html">&lt;div ng-controller=&quot;PopoverDemoCtrl&quot;&gt;
    &lt;h4&gt;Dynamic&lt;/h4&gt;
    &lt;div class=&quot;form-group&quot;&gt;
      &lt;label&gt;Popup Text:&lt;/label&gt;
      &lt;input type=&quot;text&quot; ng-model=&quot;dynamicPopover&quot; class=&quot;form-control&quot;&gt;
    &lt;/div&gt;
    &lt;div class=&quot;form-group&quot;&gt;
      &lt;label&gt;Popup Title:&lt;/label&gt;
      &lt;input type=&quot;text&quot; ng-model=&quot;dynamicPopoverTitle&quot; class=&quot;form-control&quot;&gt;
    &lt;/div&gt;
    &lt;button popover=&quot;@{{dynamicPopover}}&quot;
      popover-title=&quot;@{{dynamicPopoverTitle}}&quot; class=&quot;button&quot;&gt;Dynamic Popover&lt;/button&gt;
    
    &lt;hr /&gt;
    &lt;h4&gt;Positional&lt;/h4&gt;
    &lt;button popover-placement=&quot;top&quot; popover=&quot;On the Top!&quot; class=&quot;button&quot;&gt;Top&lt;/button&gt;
    &lt;button popover-placement=&quot;left&quot; popover=&quot;On the Left!&quot; class=&quot;button&quot;&gt;Left&lt;/button&gt;
    &lt;button popover-placement=&quot;right&quot; popover=&quot;On the Right!&quot; class=&quot;button&quot;&gt;Right&lt;/button&gt;
    &lt;button popover-placement=&quot;bottom&quot; popover=&quot;On the Bottom!&quot; class=&quot;button&quot;&gt;Bottom&lt;/button&gt;
    
    &lt;hr /&gt;
    &lt;h4&gt;Triggers&lt;/h4&gt;
    &lt;p&gt;
      &lt;button popover=&quot;I appeared on mouse enter!&quot; popover-trigger=&quot;mouseenter&quot; class=&quot;button&quot;&gt;Mouseenter&lt;/button&gt;
    &lt;/p&gt;
    &lt;input type=&quot;text&quot; value=&quot;Click me!&quot; popover=&quot;I appeared on focus! Click away and I&#x27;ll vanish...&quot;  popover-trigger=&quot;focus&quot; class=&quot;form-control&quot;&gt;

    &lt;hr /&gt;
    &lt;h4&gt;Other&lt;/h4&gt;
    &lt;button Popover-animation=&quot;true&quot; popover=&quot;I fade in and out!&quot; class=&quot;button&quot;&gt;fading&lt;/button&gt;
    &lt;button popover=&quot;I have a title!&quot; popover-title=&quot;The title.&quot; class=&quot;button&quot;&gt;title&lt;/button&gt;
&lt;/div&gt;
</code></pre>
                    </div>
                  </tab>
                  <tab heading="JavaScript">
                    <div plunker-content="javascript">
                      <pre ng-non-bindable><code data-language="javascript">var PopoverDemoCtrl = function ($scope) {
  $scope.dynamicPopover = &quot;Hello, World!&quot;;
  $scope.dynamicPopoverTitle = &quot;Title&quot;;
};
</code></pre>
                    </div>
                  </tab>
                </tabset>
              </div>
            </div>
          </section>
          <script>var PopoverDemoCtrl = function ($scope) {
  $scope.dynamicPopover = "Hello, World!";
  $scope.dynamicPopoverTitle = "Title";
};
</script>
        
          <section class="demo" id="progressbar">
            <div class="page-header">
              <h1>Progressbar<small>
                (<a target="_blank" href="https://github.com/pineconellc/angular-foundation/tree/master/src/progressbar">mm.foundation.progressbar</a>)
              </small></h1>
            </div>
            <div class="row">
              <div class="columns medium-6 show-grid">
                <div ng-controller="ProgressDemoCtrl">

    <h3>Static</h3>
    <div class="row">
        <div class="col-sm-4"><progressbar value="55"></progressbar></div>
        <div class="col-sm-4"><progressbar value="22" type="warning">22%</progressbar></div>
        <div class="col-sm-4"><progressbar max="200" value="166" type="alert"><i>166 / 200</i></progressbar></div>
    </div>

    <hr />
    <h3>Dynamic <button class="button small" type="button" ng-click="random()">Randomize</button></h3>
    <progressbar max="max" value="dynamic"><span style="color:black; white-space:nowrap;">@{{dynamic}} / @{{max}}</span></progressbar>
    
    <small><em>No animation</em></small>
    <progressbar animate="false" value="dynamic" type="success"><b>@{{dynamic}}%</b></progressbar>

    <small><em>Object (changes type based on value)</em></small>
    <progressbar class="progress-striped active" value="dynamic" type="@{{type}}">@{{type}} <i ng-show="showWarning">!!! Watch out !!!</i></progressbar>

</div>

              </div>
              <div class="columns medium-6">
                <p>A progress bar directive that is focused on providing feedback on the progress of a workflow or action.</p>

<p>It supports multiple (stacked) bars into the same <code>&lt;progress&gt;</code> element or a single <code>&lt;progressbar&gt;</code> elemtnt with optional <code>max</code> attribute and transition animations.</p>

<h3>Settings</h3>

<h4><code>&lt;progressbar&gt;</code></h4>

<ul>
<li><p><code>value</code> <i class="fa-eye"></i>
 :
 The current value of progress completed.</p></li>
<li><p><code>type</code>
 <em>(Default: null)</em> :
 Style type. Possible values are 'success', 'warning' etc.</p></li>
<li><p><code>max</code>
 <em>(Default: 100)</em> :
 A number that specifies the total value of bars that is required.</p></li>
<li><p><code>animate</code>
 <em>(Default: true)</em> :
 Whether bars use transitions to achieve the width change.</p></li>
</ul>
              </div>
            </div>
            <hr>
            <div class="row code">
              <div class="columns medium-12" ng-controller="PlunkerCtrl">
                <div class="right">
                  <button class="button secondary" id="plunk-btn" ng-click="edit('1.2.15', '5.2.0', '0.3.1', 'progressbar')"><i class="fa fa-edit"></i> Edit in plunker</button>
                </div>
                <tabset>
                  <tab heading="Markup">
                    <div plunker-content="markup">
                      <pre ng-non-bindable><code data-language="html">&lt;div ng-controller=&quot;ProgressDemoCtrl&quot;&gt;

    &lt;h3&gt;Static&lt;/h3&gt;
    &lt;div class=&quot;row&quot;&gt;
        &lt;div class=&quot;col-sm-4&quot;&gt;&lt;progressbar value=&quot;55&quot;&gt;&lt;/progressbar&gt;&lt;/div&gt;
        &lt;div class=&quot;col-sm-4&quot;&gt;&lt;progressbar value=&quot;22&quot; type=&quot;warning&quot;&gt;22%&lt;/progressbar&gt;&lt;/div&gt;
        &lt;div class=&quot;col-sm-4&quot;&gt;&lt;progressbar max=&quot;200&quot; value=&quot;166&quot; type=&quot;alert&quot;&gt;&lt;i&gt;166 / 200&lt;/i&gt;&lt;/progressbar&gt;&lt;/div&gt;
    &lt;/div&gt;

    &lt;hr /&gt;
    &lt;h3&gt;Dynamic &lt;button class=&quot;button small&quot; type=&quot;button&quot; ng-click=&quot;random()&quot;&gt;Randomize&lt;/button&gt;&lt;/h3&gt;
    &lt;progressbar max=&quot;max&quot; value=&quot;dynamic&quot;&gt;&lt;span style=&quot;color:black; white-space:nowrap;&quot;&gt;@{{dynamic}} / @{{max}}&lt;/span&gt;&lt;/progressbar&gt;
    
    &lt;small&gt;&lt;em&gt;No animation&lt;/em&gt;&lt;/small&gt;
    &lt;progressbar animate=&quot;false&quot; value=&quot;dynamic&quot; type=&quot;success&quot;&gt;&lt;b&gt;@{{dynamic}}%&lt;/b&gt;&lt;/progressbar&gt;

    &lt;small&gt;&lt;em&gt;Object (changes type based on value)&lt;/em&gt;&lt;/small&gt;
    &lt;progressbar class=&quot;progress-striped active&quot; value=&quot;dynamic&quot; type=&quot;@{{type}}&quot;&gt;@{{type}} &lt;i ng-show=&quot;showWarning&quot;&gt;!!! Watch out !!!&lt;/i&gt;&lt;/progressbar&gt;

&lt;/div&gt;
</code></pre>
                    </div>
                  </tab>
                  <tab heading="JavaScript">
                    <div plunker-content="javascript">
                      <pre ng-non-bindable><code data-language="javascript">var ProgressDemoCtrl = function ($scope) {
  
  $scope.max = 200;

  $scope.random = function() {
    var value = Math.floor((Math.random() * 100) + 1);
    var type;

    if (value &lt; 25) {
      type = &#x27;success&#x27;;
    } else if (value &lt; 50) {
      type = &#x27;info&#x27;;
    } else if (value &lt; 75) {
      type = &#x27;warning&#x27;;
    } else {
      type = &#x27;alert&#x27;;
    }

    $scope.showWarning = (type === &#x27;alert&#x27; || type === &#x27;warning&#x27;);

    $scope.dynamic = value;
    $scope.type = type;
  };
  $scope.random();
};
</code></pre>
                    </div>
                  </tab>
                </tabset>
              </div>
            </div>
          </section>
          <script>var ProgressDemoCtrl = function ($scope) {
  
  $scope.max = 200;

  $scope.random = function() {
    var value = Math.floor((Math.random() * 100) + 1);
    var type;

    if (value < 25) {
      type = 'success';
    } else if (value < 50) {
      type = 'info';
    } else if (value < 75) {
      type = 'warning';
    } else {
      type = 'alert';
    }

    $scope.showWarning = (type === 'alert' || type === 'warning');

    $scope.dynamic = value;
    $scope.type = type;
  };
  $scope.random();
};
</script>
        
          <section class="demo" id="rating">
            <div class="page-header">
              <h1>Rating<small>
                (<a target="_blank" href="https://github.com/pineconellc/angular-foundation/tree/master/src/rating">mm.foundation.rating</a>)
              </small></h1>
            </div>
            <div class="row">
              <div class="columns medium-6 show-grid">
                <div ng-controller="RatingDemoCtrl">
    <h4>Default</h4>
    <rating value="rate" max="max" readonly="isReadonly" on-hover="hoveringOver(value)" on-leave="overStar = null"></rating>
    <span class="label" ng-class="{'label-warning': percent<30, 'label-info': percent>=30 && percent<70, 'label-success': percent>=70}" ng-show="overStar && !isReadonly">@{{percent}}%</span>

    <pre style="margin:15px 0;">Rate: <b>@{{rate}}</b> - Readonly is: <i>@{{isReadonly}}</i> - Hovering over: <b>@{{overStar || "none"}}</b></pre>

    <button class="button small alert" ng-click="rate = 0" ng-disabled="isReadonly">Clear</button>
    <button class="button small" ng-click="isReadonly = ! isReadonly">Toggle Readonly</button>
    <hr />

    <h4>Custom icons</h4>
    <div ng-init="x = 5">
      <rating value="x" max="15" state-on="'fa-check-circle'" state-off="'fa-check-circle-o'"></rating>
      <b>(<i>Rate:</i> @{{x}})</b>
    </div>
    <div ng-init="y = 2">
      <rating value="y" rating-states="ratingStates"></rating>
      <b>(<i>Rate:</i> @{{y}})</b>
    </div>
</div>

              </div>
              <div class="columns medium-6">
                <p>Rating directive that will take care of visualising a star rating bar.</p>

<p>It uses Font Awesome icons (http://fontawesome.io/) by default.</p>

<h3>Settings</h3>

<h4><code>&lt;rating&gt;</code></h4>

<ul>
<li><p><code>value</code> <i class="fa fa-eye"></i>
 :
 The current rate.</p></li>
<li><p><code>max</code>
 <em>(Defaults: 5)</em> :
 Changes the number of icons.</p></li>
<li><p><code>readonly</code>
 <em>(Defaults: false)</em> :
 Prevent user's interaction.</p></li>
<li><p><code>on-hover(value)</code>
 :
 An optional expression called when user's mouse is over a particular icon.</p></li>
<li><p><code>on-leave()</code>
 :
 An optional expression called when user's mouse leaves the control altogether.</p></li>
<li><p><code>state-on</code>
 <em>(Defaults: null)</em> :
 A variable used in template to specify the state (class, src, etc) for selected icons.</p></li>
<li><p><code>state-off</code>
 <em>(Defaults: null)</em> :
 A variable used in template to specify the state for unselected icons.</p></li>
<li><p><code>rating-states</code>
 <em>(Defaults: null)</em> :
 An array of objects defining properties for all icons. In default template, <code>stateOn</code> &amp; <code>stateOff</code> property is used to specify the icon's class.</p></li>
</ul>
              </div>
            </div>
            <hr>
            <div class="row code">
              <div class="columns medium-12" ng-controller="PlunkerCtrl">
                <div class="right">
                  <button class="button secondary" id="plunk-btn" ng-click="edit('1.2.15', '5.2.0', '0.3.1', 'rating')"><i class="fa fa-edit"></i> Edit in plunker</button>
                </div>
                <tabset>
                  <tab heading="Markup">
                    <div plunker-content="markup">
                      <pre ng-non-bindable><code data-language="html">&lt;div ng-controller=&quot;RatingDemoCtrl&quot;&gt;
    &lt;h4&gt;Default&lt;/h4&gt;
    &lt;rating value=&quot;rate&quot; max=&quot;max&quot; readonly=&quot;isReadonly&quot; on-hover=&quot;hoveringOver(value)&quot; on-leave=&quot;overStar = null&quot;&gt;&lt;/rating&gt;
    &lt;span class=&quot;label&quot; ng-class=&quot;{&#x27;label-warning&#x27;: percent&lt;30, &#x27;label-info&#x27;: percent&gt;=30 &amp;&amp; percent&lt;70, &#x27;label-success&#x27;: percent&gt;=70}&quot; ng-show=&quot;overStar &amp;&amp; !isReadonly&quot;&gt;@{{percent}}%&lt;/span&gt;

    &lt;pre style=&quot;margin:15px 0;&quot;&gt;Rate: &lt;b&gt;@{{rate}}&lt;/b&gt; - Readonly is: &lt;i&gt;@{{isReadonly}}&lt;/i&gt; - Hovering over: &lt;b&gt;@{{overStar || &quot;none&quot;}}&lt;/b&gt;&lt;/pre&gt;

    &lt;button class=&quot;button small alert&quot; ng-click=&quot;rate = 0&quot; ng-disabled=&quot;isReadonly&quot;&gt;Clear&lt;/button&gt;
    &lt;button class=&quot;button small&quot; ng-click=&quot;isReadonly = ! isReadonly&quot;&gt;Toggle Readonly&lt;/button&gt;
    &lt;hr /&gt;

    &lt;h4&gt;Custom icons&lt;/h4&gt;
    &lt;div ng-init=&quot;x = 5&quot;&gt;
      &lt;rating value=&quot;x&quot; max=&quot;15&quot; state-on=&quot;&#x27;fa-check-circle&#x27;&quot; state-off=&quot;&#x27;fa-check-circle-o&#x27;&quot;&gt;&lt;/rating&gt;
      &lt;b&gt;(&lt;i&gt;Rate:&lt;/i&gt; @{{x}})&lt;/b&gt;
    &lt;/div&gt;
    &lt;div ng-init=&quot;y = 2&quot;&gt;
      &lt;rating value=&quot;y&quot; rating-states=&quot;ratingStates&quot;&gt;&lt;/rating&gt;
      &lt;b&gt;(&lt;i&gt;Rate:&lt;/i&gt; @{{y}})&lt;/b&gt;
    &lt;/div&gt;
&lt;/div&gt;
</code></pre>
                    </div>
                  </tab>
                  <tab heading="JavaScript">
                    <div plunker-content="javascript">
                      <pre ng-non-bindable><code data-language="javascript">var RatingDemoCtrl = function ($scope) {
  $scope.rate = 7;
  $scope.max = 10;
  $scope.isReadonly = false;

  $scope.hoveringOver = function(value) {
    $scope.overStar = value;
    $scope.percent = 100 * (value / $scope.max);
  };

  $scope.ratingStates = [
    {stateOn: &#x27;fa-check-circle&#x27;, stateOff: &#x27;fa-check-circle-o&#x27;},
    {stateOn: &#x27;fa-star&#x27;, stateOff: &#x27;fa-start-o&#x27;},
    {stateOn: &#x27;fa-heart&#x27;, stateOff: &#x27;fa-ban&#x27;},
    {stateOn: &#x27;fa-heart&#x27;},
    {stateOff: &#x27;fa-power-off&#x27;}
  ];
};
</code></pre>
                    </div>
                  </tab>
                </tabset>
              </div>
            </div>
          </section>
          <script>var RatingDemoCtrl = function ($scope) {
  $scope.rate = 7;
  $scope.max = 10;
  $scope.isReadonly = false;

  $scope.hoveringOver = function(value) {
    $scope.overStar = value;
    $scope.percent = 100 * (value / $scope.max);
  };

  $scope.ratingStates = [
    {stateOn: 'fa-check-circle', stateOff: 'fa-check-circle-o'},
    {stateOn: 'fa-star', stateOff: 'fa-start-o'},
    {stateOn: 'fa-heart', stateOff: 'fa-ban'},
    {stateOn: 'fa-heart'},
    {stateOff: 'fa-power-off'}
  ];
};
</script>
        
          <section class="demo" id="tabs">
            <div class="page-header">
              <h1>Tabs<small>
                (<a target="_blank" href="https://github.com/pineconellc/angular-foundation/tree/master/src/tabs">mm.foundation.tabs</a>)
              </small></h1>
            </div>
            <div class="row">
              <div class="columns medium-6 show-grid">
                <div ng-controller="TabsDemoCtrl">
  <p>Select a tab by setting active binding to true:</p>
  <p>
    <button class="button small" ng-click="tabs[0].active = true">Select second tab</button>
    <button class="button small" ng-click="tabs[1].active = true">Select third tab</button>
  </p>
  <hr />

  <tabset>
    <tab heading="Static title">Static content</tab>
    <tab ng-repeat="tab in tabs" heading="@{{tab.title}}" active="tab.active">
      @{{tab.content}}
    </tab>
    <tab select="alertMe()">
      <tab-heading>
        <i class="fa fa-bell"></i> Alert!
      </tab-heading>
      I've got an HTML heading, and a select callback. Pretty cool!
    </tab>
  </tabset>

  <hr />

  <tabset vertical="true" type="navType">
    <tab heading="Vertical 1">Vertical content 1</tab>
    <tab heading="Vertical 2">Vertical content 2</tab>
  </tabset>

  <hr />
</div>

              </div>
              <div class="columns medium-6">
                <p>Foundation version of the tabs directive.</p>

<h3>Settings</h3>

<h4><code>&lt;tabset&gt;</code></h4>

<ul>
<li><code>vertical</code>
 <em>(Defaults: false)</em> :
 Whether tabs appear vertically stacked.</li>
</ul>

<h4><code>&lt;tab&gt;</code></h4>

<ul>
<li><p><code>heading</code> or <code>&lt;tab-heading&gt;</code>
 :
 Heading text or HTML markup.</p></li>
<li><p><code>active</code> <i class="fa fa-eye"></i>
 <em>(Defaults: false)</em> :
 Whether tab is currently selected.</p></li>
<li><p><code>select()</code>
 <em>(Defaults: null)</em> :
 An optional expression called when tab is activated.</p></li>
</ul>
              </div>
            </div>
            <hr>
            <div class="row code">
              <div class="columns medium-12" ng-controller="PlunkerCtrl">
                <div class="right">
                  <button class="button secondary" id="plunk-btn" ng-click="edit('1.2.15', '5.2.0', '0.3.1', 'tabs')"><i class="fa fa-edit"></i> Edit in plunker</button>
                </div>
                <tabset>
                  <tab heading="Markup">
                    <div plunker-content="markup">
                      <pre ng-non-bindable><code data-language="html">&lt;div ng-controller=&quot;TabsDemoCtrl&quot;&gt;
  &lt;p&gt;Select a tab by setting active binding to true:&lt;/p&gt;
  &lt;p&gt;
    &lt;button class=&quot;button small&quot; ng-click=&quot;tabs[0].active = true&quot;&gt;Select second tab&lt;/button&gt;
    &lt;button class=&quot;button small&quot; ng-click=&quot;tabs[1].active = true&quot;&gt;Select third tab&lt;/button&gt;
  &lt;/p&gt;
  &lt;hr /&gt;

  &lt;tabset&gt;
    &lt;tab heading=&quot;Static title&quot;&gt;Static content&lt;/tab&gt;
    &lt;tab ng-repeat=&quot;tab in tabs&quot; heading=&quot;@{{tab.title}}&quot; active=&quot;tab.active&quot;&gt;
      @{{tab.content}}
    &lt;/tab&gt;
    &lt;tab select=&quot;alertMe()&quot;&gt;
      &lt;tab-heading&gt;
        &lt;i class=&quot;fa fa-bell&quot;&gt;&lt;/i&gt; Alert!
      &lt;/tab-heading&gt;
      I&#x27;ve got an HTML heading, and a select callback. Pretty cool!
    &lt;/tab&gt;
  &lt;/tabset&gt;

  &lt;hr /&gt;

  &lt;tabset vertical=&quot;true&quot; type=&quot;navType&quot;&gt;
    &lt;tab heading=&quot;Vertical 1&quot;&gt;Vertical content 1&lt;/tab&gt;
    &lt;tab heading=&quot;Vertical 2&quot;&gt;Vertical content 2&lt;/tab&gt;
  &lt;/tabset&gt;

  &lt;hr /&gt;
&lt;/div&gt;
</code></pre>
                    </div>
                  </tab>
                  <tab heading="JavaScript">
                    <div plunker-content="javascript">
                      <pre ng-non-bindable><code data-language="javascript">var TabsDemoCtrl = function ($scope) {
  $scope.tabs = [
    { title:&quot;Dynamic Title 1&quot;, content:&quot;Dynamic content 1&quot; },
    { title:&quot;Dynamic Title 2&quot;, content:&quot;Dynamic content 2&quot; }
  ];

  $scope.alertMe = function() {
    setTimeout(function() {
      alert(&quot;You&#x27;ve selected the alert tab!&quot;);
    });
  };
};
</code></pre>
                    </div>
                  </tab>
                </tabset>
              </div>
            </div>
          </section>
          <script>var TabsDemoCtrl = function ($scope) {
  $scope.tabs = [
    { title:"Dynamic Title 1", content:"Dynamic content 1" },
    { title:"Dynamic Title 2", content:"Dynamic content 2" }
  ];

  $scope.alertMe = function() {
    setTimeout(function() {
      alert("You've selected the alert tab!");
    });
  };
};
</script>
        
          <section class="demo" id="tooltip">
            <div class="page-header">
              <h1>Tooltip<small>
                (<a target="_blank" href="https://github.com/pineconellc/angular-foundation/tree/master/src/tooltip">mm.foundation.tooltip</a>)
              </small></h1>
            </div>
            <div class="row">
              <div class="columns medium-6 show-grid">
                <div ng-controller="TooltipDemoCtrl">
    <div class="form-group">
      <label>Dynamic Tooltip Text</label>
      <input type="text" ng-model="dynamicTooltipText" class="form-control">
    </div>
    <div class="form-group">
      <label>Dynamic Tooltip Popup Text</label>
      <input type="text" ng-model="dynamicTooltip" class="form-control">
    </div>
    <p>
      Pellentesque <a href="#" class="has-tip" tooltip="@{{dynamicTooltip}}">@{{dynamicTooltipText}}</a>,
      sit amet venenatis urna cursus eget nunc scelerisque viverra mauris, in
      aliquam. Tincidunt lobortis feugiat vivamus at 
      <a href="#" class="has-tip" tooltip-placement="left" tooltip="On the Left!">left</a> eget
      arcu dictum varius duis at consectetur lorem. Vitae elementum curabitur
      <a href="#" class="has-tip" tooltip-placement="right" tooltip="On the Right!">right</a> 
      nunc sed velit dignissim sodales ut eu sem integer vitae. Turpis egestas 
      <a href="#" class="has-tip" tooltip-placement="bottom" tooltip="On the Bottom!">bottom</a> 
      pharetra convallis posuere morbi leo urna, 
      <a href="#" class="has-tip" tooltip-animation="false" tooltip="I don't fade. :-(">fading</a>
      at elementum eu, facilisis sed odio morbi quis commodo odio. In cursus
      <a href="#" class="has-tip" tooltip-popup-delay='1000' tooltip='appears with delay'>delayed</a> turpis massa tincidunt dui ut.
    </p>

    <p>
      I can even contain HTML. <a href="#" class="has-tip" tooltip-html-unsafe="@{{htmlTooltip}}">Check me out!</a>
    </p>

    <form role="form">
      <div class="form-group">
        <label>Or use custom triggers, like focus: </label>
        <input type="text" value="Click me!" tooltip="See? Now click away..."  tooltip-trigger="focus" tooltip-placement="right" class="form-control" />
      </div>
    </form>
</div>

              </div>
              <div class="columns medium-6">
                <p>A lightweight, extensible directive for fancy tooltip creation. The tooltip
directive supports multiple placements, optional transition animation, and more.</p>

<p>There are two versions of the tooltip: <code>tooltip</code> and <code>tooltip-html-unsafe</code>. The
former takes text only and will escape any HTML provided. The latter takes
whatever HTML is provided and displays it in a tooltip; it called "unsafe"
because the HTML is not sanitized. <em>The user is responsible for ensuring the
content is safe to put into the DOM!</em></p>

<p>The tooltip directives provide several optional attributes to control how they
will display:</p>

<ul>
<li><code>tooltip-placement</code>: Where to place it? Defaults to "top", but also accepts
"bottom", "left", "right".</li>
<li><code>tooltip-animation</code>: Should it fade in and out? Defaults to "true".</li>
<li><code>tooltip-popup-delay</code>: For how long should the user have to have the mouse
over the element before the tooltip shows (in milliseconds)? Defaults to 0.</li>
<li><code>tooltip-trigger</code>: What should trigger a show of the tooltip?</li>
<li><code>tooltip-append-to-body</code>: Should the tooltip be appended to <code>$body</code> instead of
the parent element?</li>
</ul>

<p>The tooltip directives require the <code>$position</code> service.</p>

<p><strong>Triggers</strong></p>

<p>The following show triggers are supported out of the box, along with their
provided hide triggers:</p>

<ul>
<li><code>mouseenter</code>: <code>mouseleave</code></li>
<li><code>click</code>: <code>click</code></li>
<li><code>focus</code>: <code>blur</code></li>
</ul>

<p>For any non-supported value, the trigger will be used to both show and hide the
tooltip.</p>

<p><strong>$tooltipProvider</strong></p>

<p>Through the <code>$tooltipProvider</code>, you can change the way tooltips and popovers
behave by default; the attributes above always take precedence. The following
methods are available:</p>

<ul>
<li><code>setTriggers( obj )</code>: Extends the default trigger mappings mentioned above
with mappings of your own. E.g. <code>{ 'openTrigger': 'closeTrigger' }</code>.</li>
<li><p><code>options( obj )</code>: Provide a set of defaults for certain tooltip and popover
attributes. Currently supports 'placement', 'animation', 'popupDelay', and
<code>appendToBody</code>. Here are the defaults:</p>

<pre>
placement: 'top',
animation: true,
popupDelay: 0,
appendToBody: false
</pre></li>
</ul>
              </div>
            </div>
            <hr>
            <div class="row code">
              <div class="columns medium-12" ng-controller="PlunkerCtrl">
                <div class="right">
                  <button class="button secondary" id="plunk-btn" ng-click="edit('1.2.15', '5.2.0', '0.3.1', 'tooltip')"><i class="fa fa-edit"></i> Edit in plunker</button>
                </div>
                <tabset>
                  <tab heading="Markup">
                    <div plunker-content="markup">
                      <pre ng-non-bindable><code data-language="html">&lt;div ng-controller=&quot;TooltipDemoCtrl&quot;&gt;
    &lt;div class=&quot;form-group&quot;&gt;
      &lt;label&gt;Dynamic Tooltip Text&lt;/label&gt;
      &lt;input type=&quot;text&quot; ng-model=&quot;dynamicTooltipText&quot; class=&quot;form-control&quot;&gt;
    &lt;/div&gt;
    &lt;div class=&quot;form-group&quot;&gt;
      &lt;label&gt;Dynamic Tooltip Popup Text&lt;/label&gt;
      &lt;input type=&quot;text&quot; ng-model=&quot;dynamicTooltip&quot; class=&quot;form-control&quot;&gt;
    &lt;/div&gt;
    &lt;p&gt;
      Pellentesque &lt;a href=&quot;#&quot; class=&quot;has-tip&quot; tooltip=&quot;@{{dynamicTooltip}}&quot;&gt;@{{dynamicTooltipText}}&lt;/a&gt;,
      sit amet venenatis urna cursus eget nunc scelerisque viverra mauris, in
      aliquam. Tincidunt lobortis feugiat vivamus at 
      &lt;a href=&quot;#&quot; class=&quot;has-tip&quot; tooltip-placement=&quot;left&quot; tooltip=&quot;On the Left!&quot;&gt;left&lt;/a&gt; eget
      arcu dictum varius duis at consectetur lorem. Vitae elementum curabitur
      &lt;a href=&quot;#&quot; class=&quot;has-tip&quot; tooltip-placement=&quot;right&quot; tooltip=&quot;On the Right!&quot;&gt;right&lt;/a&gt; 
      nunc sed velit dignissim sodales ut eu sem integer vitae. Turpis egestas 
      &lt;a href=&quot;#&quot; class=&quot;has-tip&quot; tooltip-placement=&quot;bottom&quot; tooltip=&quot;On the Bottom!&quot;&gt;bottom&lt;/a&gt; 
      pharetra convallis posuere morbi leo urna, 
      &lt;a href=&quot;#&quot; class=&quot;has-tip&quot; tooltip-animation=&quot;false&quot; tooltip=&quot;I don&#x27;t fade. :-(&quot;&gt;fading&lt;/a&gt;
      at elementum eu, facilisis sed odio morbi quis commodo odio. In cursus
      &lt;a href=&quot;#&quot; class=&quot;has-tip&quot; tooltip-popup-delay=&#x27;1000&#x27; tooltip=&#x27;appears with delay&#x27;&gt;delayed&lt;/a&gt; turpis massa tincidunt dui ut.
    &lt;/p&gt;

    &lt;p&gt;
      I can even contain HTML. &lt;a href=&quot;#&quot; class=&quot;has-tip&quot; tooltip-html-unsafe=&quot;@{{htmlTooltip}}&quot;&gt;Check me out!&lt;/a&gt;
    &lt;/p&gt;

    &lt;form role=&quot;form&quot;&gt;
      &lt;div class=&quot;form-group&quot;&gt;
        &lt;label&gt;Or use custom triggers, like focus: &lt;/label&gt;
        &lt;input type=&quot;text&quot; value=&quot;Click me!&quot; tooltip=&quot;See? Now click away...&quot;  tooltip-trigger=&quot;focus&quot; tooltip-placement=&quot;right&quot; class=&quot;form-control&quot; /&gt;
      &lt;/div&gt;
    &lt;/form&gt;
&lt;/div&gt;
</code></pre>
                    </div>
                  </tab>
                  <tab heading="JavaScript">
                    <div plunker-content="javascript">
                      <pre ng-non-bindable><code data-language="javascript">var TooltipDemoCtrl = function ($scope) {
  $scope.dynamicTooltip = &quot;Hello, World!&quot;;
  $scope.dynamicTooltipText = &quot;dynamic&quot;;
  $scope.htmlTooltip = &quot;I&#x27;ve been made &lt;b&gt;bold&lt;/b&gt;!&quot;;
};
</code></pre>
                    </div>
                  </tab>
                </tabset>
              </div>
            </div>
          </section>
          <script>var TooltipDemoCtrl = function ($scope) {
  $scope.dynamicTooltip = "Hello, World!";
  $scope.dynamicTooltipText = "dynamic";
  $scope.htmlTooltip = "I've been made <b>bold</b>!";
};
</script>
        
          <section class="demo" id="topbar">
            <div class="page-header">
              <h1>Topbar<small>
                (<a target="_blank" href="https://github.com/pineconellc/angular-foundation/tree/master/src/topbar">mm.foundation.topbar</a>)
              </small></h1>
            </div>
            <div class="row">
              <div class="columns medium-6 show-grid">
                <div ng-controller="TopBarDemoCtrl">
  <top-bar>
    <ul class="title-area">
      <li class="name">
        <h1><a href="#">My Site</a></h1>
      </li>
      <li toggle-top-bar class="menu-icon"><a href="#">Menu</a></li>
    </ul>

    <top-bar-section>
      <!-- Right Nav Section -->
      <ul class="right">
        <li class="active"><a href="#">Active</a></li>
        <li has-dropdown>
          <a href="#">Dropdown</a>
          <ul top-bar-dropdown>
            <li><a href="#">First link in dropdown</a></li>
          </ul>
        </li>
      </ul>

      <!-- Left Nav Section -->
      <ul class="left">
        <li><a href="#">Left</a></li>
      </ul>
    </top-bar-section>
  </top-bar>
</div>
              </div>
              <div class="columns medium-6">
                <p>A directive that provides the <a href="http://foundation.zurb.com/docs/components/topbar.html">Foundation Top Bar</a> component.</p>

<p>The directive has virtually identical behavior to Foundation Top Bar. The markup however, is slightly different. The top bar consist of a root <code>top-bar</code> element with nested <code>top-bar-section</code> elements that encapsulate menus. The <code>title-area</code> list is also a direct descendant of the root element. The mobile menu toggle is created by adding the <code>toggle-top-bar</code> attribute to a <code>li</code> element inside the title area. Applying <code>menu-icon</code> class to this element will trigger the icon as determined by the Foundation CSS. <code>li</code> elements that contain nested menus need to have the <code>has-dropdown</code> attribute. The nested list itself should have the <code>top-bar-dropdown</code> attribute.</p>

<p>The following settings can be applied as attributes to the <code>top-bar</code> element:</p>

<ul>
<li><code>sticky-class</code>: Class name that will trigger sticky behavior.</li>
<li><code>custom-back-text</code>: Set this to false and it will pull the top level link name as the back text.</li>
<li><code>back-text</code>: Define what you want your custom back text to be if custom-back-text is set.</li>
<li><code>is-hover</code>: Toggle drop down menus on hover.</li>
<li><code>mobile-show-parent-link</code>: will copy parent links into dropdowns for mobile navigation.</li>
<li><code>scrolltop</code>: jump to top when sticky nav menu toggle is clicked</li>
</ul>

<p>See the demo page for example on how to use this and visit the <a href="http://foundation.zurb.com/docs/components/topbar.html">Foundation docs</a> for more details.</p>
              </div>
            </div>
            <hr>
            <div class="row code">
              <div class="columns medium-12" ng-controller="PlunkerCtrl">
                <div class="right">
                  <button class="button secondary" id="plunk-btn" ng-click="edit('1.2.15', '5.2.0', '0.3.1', 'topbar')"><i class="fa fa-edit"></i> Edit in plunker</button>
                </div>
                <tabset>
                  <tab heading="Markup">
                    <div plunker-content="markup">
                      <pre ng-non-bindable><code data-language="html">&lt;div ng-controller=&quot;TopBarDemoCtrl&quot;&gt;
  &lt;top-bar&gt;
    &lt;ul class=&quot;title-area&quot;&gt;
      &lt;li class=&quot;name&quot;&gt;
        &lt;h1&gt;&lt;a href=&quot;#&quot;&gt;My Site&lt;/a&gt;&lt;/h1&gt;
      &lt;/li&gt;
      &lt;li toggle-top-bar class=&quot;menu-icon&quot;&gt;&lt;a href=&quot;#&quot;&gt;Menu&lt;/a&gt;&lt;/li&gt;
    &lt;/ul&gt;

    &lt;top-bar-section&gt;
      &lt;!-- Right Nav Section --&gt;
      &lt;ul class=&quot;right&quot;&gt;
        &lt;li class=&quot;active&quot;&gt;&lt;a href=&quot;#&quot;&gt;Active&lt;/a&gt;&lt;/li&gt;
        &lt;li has-dropdown&gt;
          &lt;a href=&quot;#&quot;&gt;Dropdown&lt;/a&gt;
          &lt;ul top-bar-dropdown&gt;
            &lt;li&gt;&lt;a href=&quot;#&quot;&gt;First link in dropdown&lt;/a&gt;&lt;/li&gt;
          &lt;/ul&gt;
        &lt;/li&gt;
      &lt;/ul&gt;

      &lt;!-- Left Nav Section --&gt;
      &lt;ul class=&quot;left&quot;&gt;
        &lt;li&gt;&lt;a href=&quot;#&quot;&gt;Left&lt;/a&gt;&lt;/li&gt;
      &lt;/ul&gt;
    &lt;/top-bar-section&gt;
  &lt;/top-bar&gt;
&lt;/div&gt;</code></pre>
                    </div>
                  </tab>
                  <tab heading="JavaScript">
                    <div plunker-content="javascript">
                      <pre ng-non-bindable><code data-language="javascript">var TopBarDemoCtrl = function ($scope) {

};
</code></pre>
                    </div>
                  </tab>
                </tabset>
              </div>
            </div>
          </section>
          <script>var TopBarDemoCtrl = function ($scope) {

};
</script>
        
          <section class="demo" id="tour">
            <div class="page-header">
              <h1>Tour<small>
                (<a target="_blank" href="https://github.com/pineconellc/angular-foundation/tree/master/src/tour">mm.foundation.tour</a>)
              </small></h1>
            </div>
            <div class="row">
              <div class="columns medium-6 show-grid">
                <div ng-controller="TourDemoCtrl">
  <button ng-click="startTour()">Start tour</button>
  <div class="panel"
    step-text="Hello, this is the first step of the tour."
    step-index="1"
    step-placement="bottom">
    First tour step points here
  </div>
  <div class="panel"
    step-text="This is another step of the tour."
    step-index="2"
    step-placement="right">
    Second tour step points here
  </div>
  <div class="panel"
    step-text="Last step. Finally."
    step-index="3">
    Third tour step points here
  </div>
</div>

              </div>
              <div class="columns medium-6">
                <p>A <code>$tour</code> service to give users of your website or app a tour when they
visit. It works in conjunction with a <code>step-text</code> directive. This is an angular-focused
refactoring of the <a href="http://foundation.zurb.com/docs/components/joyride.html">Foundation Joyride</a> component.</p>

<p>The step directive <strong>requires</strong> the tooltip module and supports multiple
placements, optional transition animation, and more.</p>

<p>Required attributes are:</p>

<ul>
<li><code>step-text</code>: The text to show in the tour popup when the tour is focused on the element.</li>
<li><code>step-index</code>: The order in which the tour should focus on the element strting with <code>1</code>.</li>
</ul>

<p>The <code>step-text</code> directive provides several optional attributes to control how it
will display:</p>

<ul>
<li><code>step-title</code>: A string to display as a fancy title.</li>
<li><code>step-placement</code>: Where to place it? Defaults to "top", but also accepts
"bottom", "left", "right".</li>
<li><code>step-animation</code>: Should it fade in and out? Defaults to "true".</li>
<li><code>step-popup-delay</code>: For how long should the user have to have the mouse
over the element before the step shows (in milliseconds)? Defaults to 0.</li>
<li><code>step-trigger</code>: What should trigger the show of the step? See the
<code>tooltip</code> directive for supported values.</li>
<li><code>step-append-to-body</code>: Should the tooltip be appended to <code>$body</code> instead of
the parent element?</li>
</ul>

<p>The step directive requires the <code>$position</code> service.</p>

<p>The step directive also supports various default configurations through the
$tooltipProvider. See the <a href="#tooltip">tooltip</a> section for more information.</p>
              </div>
            </div>
            <hr>
            <div class="row code">
              <div class="columns medium-12" ng-controller="PlunkerCtrl">
                <div class="right">
                  <button class="button secondary" id="plunk-btn" ng-click="edit('1.2.15', '5.2.0', '0.3.1', 'tour')"><i class="fa fa-edit"></i> Edit in plunker</button>
                </div>
                <tabset>
                  <tab heading="Markup">
                    <div plunker-content="markup">
                      <pre ng-non-bindable><code data-language="html">&lt;div ng-controller=&quot;TourDemoCtrl&quot;&gt;
  &lt;button ng-click=&quot;startTour()&quot;&gt;Start tour&lt;/button&gt;
  &lt;div class=&quot;panel&quot;
    step-text=&quot;Hello, this is the first step of the tour.&quot;
    step-index=&quot;1&quot;
    step-placement=&quot;bottom&quot;&gt;
    First tour step points here
  &lt;/div&gt;
  &lt;div class=&quot;panel&quot;
    step-text=&quot;This is another step of the tour.&quot;
    step-index=&quot;2&quot;
    step-placement=&quot;right&quot;&gt;
    Second tour step points here
  &lt;/div&gt;
  &lt;div class=&quot;panel&quot;
    step-text=&quot;Last step. Finally.&quot;
    step-index=&quot;3&quot;&gt;
    Third tour step points here
  &lt;/div&gt;
&lt;/div&gt;
</code></pre>
                    </div>
                  </tab>
                  <tab heading="JavaScript">
                    <div plunker-content="javascript">
                      <pre ng-non-bindable><code data-language="javascript">var TourDemoCtrl = function ($scope, $tour) {
  $scope.startTour = $tour.start;
};
</code></pre>
                    </div>
                  </tab>
                </tabset>
              </div>
            </div>
          </section>
          <script>var TourDemoCtrl = function ($scope, $tour) {
  $scope.startTour = $tour.start;
};
</script>
        
          <section class="demo" id="typeahead">
            <div class="page-header">
              <h1>Typeahead<small>
                (<a target="_blank" href="https://github.com/pineconellc/angular-foundation/tree/master/src/typeahead">mm.foundation.typeahead</a>)
              </small></h1>
            </div>
            <div class="row">
              <div class="columns medium-6 show-grid">
                <script type="text/ng-template" id="customTemplate.html">
  <a>
      <img ng-src="http://upload.wikimedia.org/wikipedia/commons/thumb/@{{match.model.flag}}" width="16">
      <span bind-html-unsafe="match.label | typeaheadHighlight:query"></span>
  </a>
</script>
<div class='container-fluid' ng-controller="TypeaheadCtrl">

    <h4>Static arrays</h4>
    <pre>Model: @{{selected | json}}</pre>
    <input type="text" ng-model="selected" typeahead="state for state in states | filter:$viewValue | limitTo:8" class="form-control">

    <h4>Asynchronous results</h4>
    <pre>Model: @{{asyncSelected | json}}</pre>
    <input type="text" ng-model="asyncSelected" placeholder="Locations loaded via $http" typeahead="address for address in getLocation($viewValue) | filter:$viewValue" typeahead-loading="loadingLocations" class="form-control">
    <i ng-show="loadingLocations" class="glyphicon glyphicon-refresh"></i>

    <h4>Custom templates for results</h4>
    <pre>Model: @{{customSelected | json}}</pre>
    <input type="text" ng-model="customSelected" placeholder="Custom template" typeahead="state as state.name for state in statesWithFlags | filter:{name:$viewValue}" typeahead-template-url="customTemplate.html" class="form-control">
</div>

              </div>
              <div class="columns medium-6">
                <p>Typeahead is a AngularJS version of <a href="http://getbootstrap.com/2.3.2/javascript.html#typeahead">Bootstrap v2's typeahead plugin</a>.
This directive can be used to quickly create elegant typeaheads with any form text input.</p>

<p>It is very well integrated into AngularJS as it uses a subset of the
<a href="http://docs.angularjs.org/api/ng.directive:select">select directive</a> syntax, which is very flexible. Supported expressions are:</p>

<ul>
<li><em>label</em> for <em>value</em> in <em>sourceArray</em></li>
<li><em>select</em> as <em>label</em> for <em>value</em> in <em>sourceArray</em></li>
</ul>

<p>The <code>sourceArray</code> expression can use a special <code>$viewValue</code> variable that corresponds to the value entered inside the input.</p>

<p>This directive works with promises, meaning you can retrieve matches using the <code>$http</code> service with minimal effort.</p>

<p>The typeahead directives provide several attributes:</p>

<ul>
<li><p><code>ng-model</code> <i class="glyphicon glyphicon-eye-open"></i>
:
Assignable angular expression to data-bind to</p></li>
<li><p><code>typeahead</code> <i class="glyphicon glyphicon-eye-open"></i>
:
Comprehension Angular expression (see <a href="http://docs.angularjs.org/api/ng.directive:select">select directive</a>)</p></li>
<li><p><code>typeahead-editable</code> <i class="glyphicon glyphicon-eye-open"></i>
<em>(Defaults: true)</em> :
Should it restrict model values to the ones selected from the popup only ?</p></li>
<li><p><code>typeahead-input-formatter</code> <i class="glyphicon glyphicon-eye-open"></i>
<em>(Defaults: undefined)</em> :
Format the ng-model result after selection</p></li>
<li><p><code>typeahead-loading</code> <i class="glyphicon glyphicon-eye-open"></i>
<em>(Defaults: angular.noop)</em> :
Binding to a variable that indicates if matches are being retrieved asynchronously</p></li>
<li><p><code>typeahead-min-length</code> <i class="glyphicon glyphicon-eye-open"></i>
<em>(Defaults: 1)</em> :
Minimal no of characters that needs to be entered before typeahead kicks-in</p></li>
<li><p><code>typeahead-on-select</code> <i class="glyphicon glyphicon-eye-open"></i>
<em>(Defaults: null)</em> :
A callback executed when a match is selected</p></li>
<li><p><code>typeahead-template-url</code> <i class="glyphicon glyphicon-eye-open"></i>
:
Set custom item template</p></li>
<li><p><code>typeahead-wait-ms</code> <i class="glyphicon glyphicon-eye-open"></i>
<em>(Defaults: 0)</em> :
Minimal wait time after last character typed before typeahead kicks-in</p></li>
</ul>
              </div>
            </div>
            <hr>
            <div class="row code">
              <div class="columns medium-12" ng-controller="PlunkerCtrl">
                <div class="right">
                  <button class="button secondary" id="plunk-btn" ng-click="edit('1.2.15', '5.2.0', '0.3.1', 'typeahead')"><i class="fa fa-edit"></i> Edit in plunker</button>
                </div>
                <tabset>
                  <tab heading="Markup">
                    <div plunker-content="markup">
                      <pre ng-non-bindable><code data-language="html">&lt;script type=&quot;text/ng-template&quot; id=&quot;customTemplate.html&quot;&gt;
  &lt;a&gt;
      &lt;img ng-src=&quot;http://upload.wikimedia.org/wikipedia/commons/thumb/@{{match.model.flag}}&quot; width=&quot;16&quot;&gt;
      &lt;span bind-html-unsafe=&quot;match.label | typeaheadHighlight:query&quot;&gt;&lt;/span&gt;
  &lt;/a&gt;
&lt;/script&gt;
&lt;div class=&#x27;container-fluid&#x27; ng-controller=&quot;TypeaheadCtrl&quot;&gt;

    &lt;h4&gt;Static arrays&lt;/h4&gt;
    &lt;pre&gt;Model: @{{selected | json}}&lt;/pre&gt;
    &lt;input type=&quot;text&quot; ng-model=&quot;selected&quot; typeahead=&quot;state for state in states | filter:$viewValue | limitTo:8&quot; class=&quot;form-control&quot;&gt;

    &lt;h4&gt;Asynchronous results&lt;/h4&gt;
    &lt;pre&gt;Model: @{{asyncSelected | json}}&lt;/pre&gt;
    &lt;input type=&quot;text&quot; ng-model=&quot;asyncSelected&quot; placeholder=&quot;Locations loaded via $http&quot; typeahead=&quot;address for address in getLocation($viewValue) | filter:$viewValue&quot; typeahead-loading=&quot;loadingLocations&quot; class=&quot;form-control&quot;&gt;
    &lt;i ng-show=&quot;loadingLocations&quot; class=&quot;glyphicon glyphicon-refresh&quot;&gt;&lt;/i&gt;

    &lt;h4&gt;Custom templates for results&lt;/h4&gt;
    &lt;pre&gt;Model: @{{customSelected | json}}&lt;/pre&gt;
    &lt;input type=&quot;text&quot; ng-model=&quot;customSelected&quot; placeholder=&quot;Custom template&quot; typeahead=&quot;state as state.name for state in statesWithFlags | filter:{name:$viewValue}&quot; typeahead-template-url=&quot;customTemplate.html&quot; class=&quot;form-control&quot;&gt;
&lt;/div&gt;
</code></pre>
                    </div>
                  </tab>
                  <tab heading="JavaScript">
                    <div plunker-content="javascript">
                      <pre ng-non-bindable><code data-language="javascript">function TypeaheadCtrl($scope, $http) {

  $scope.selected = undefined;
  $scope.states = [&#x27;Alabama&#x27;, &#x27;Alaska&#x27;, &#x27;Arizona&#x27;, &#x27;Arkansas&#x27;, &#x27;California&#x27;, &#x27;Colorado&#x27;, &#x27;Connecticut&#x27;, &#x27;Delaware&#x27;, &#x27;Florida&#x27;, &#x27;Georgia&#x27;, &#x27;Hawaii&#x27;, &#x27;Idaho&#x27;, &#x27;Illinois&#x27;, &#x27;Indiana&#x27;, &#x27;Iowa&#x27;, &#x27;Kansas&#x27;, &#x27;Kentucky&#x27;, &#x27;Louisiana&#x27;, &#x27;Maine&#x27;, &#x27;Maryland&#x27;, &#x27;Massachusetts&#x27;, &#x27;Michigan&#x27;, &#x27;Minnesota&#x27;, &#x27;Mississippi&#x27;, &#x27;Missouri&#x27;, &#x27;Montana&#x27;, &#x27;Nebraska&#x27;, &#x27;Nevada&#x27;, &#x27;New Hampshire&#x27;, &#x27;New Jersey&#x27;, &#x27;New Mexico&#x27;, &#x27;New York&#x27;, &#x27;North Dakota&#x27;, &#x27;North Carolina&#x27;, &#x27;Ohio&#x27;, &#x27;Oklahoma&#x27;, &#x27;Oregon&#x27;, &#x27;Pennsylvania&#x27;, &#x27;Rhode Island&#x27;, &#x27;South Carolina&#x27;, &#x27;South Dakota&#x27;, &#x27;Tennessee&#x27;, &#x27;Texas&#x27;, &#x27;Utah&#x27;, &#x27;Vermont&#x27;, &#x27;Virginia&#x27;, &#x27;Washington&#x27;, &#x27;West Virginia&#x27;, &#x27;Wisconsin&#x27;, &#x27;Wyoming&#x27;];
  // Any function returning a promise object can be used to load values asynchronously
  $scope.getLocation = function(val) {
    return $http.get(&#x27;http://maps.googleapis.com/maps/api/geocode/json&#x27;, {
      params: {
        address: val,
        sensor: false
      }
    }).then(function(res){
      var addresses = [];
      angular.forEach(res.data.results, function(item){
        addresses.push(item.formatted_address);
      });
      return addresses;
    });
  };

  $scope.statesWithFlags = [{&quot;name&quot;:&quot;Alabama&quot;,&quot;flag&quot;:&quot;5/5c/Flag_of_Alabama.svg/45px-Flag_of_Alabama.svg.png&quot;},{&quot;name&quot;:&quot;Alaska&quot;,&quot;flag&quot;:&quot;e/e6/Flag_of_Alaska.svg/43px-Flag_of_Alaska.svg.png&quot;},{&quot;name&quot;:&quot;Arizona&quot;,&quot;flag&quot;:&quot;9/9d/Flag_of_Arizona.svg/45px-Flag_of_Arizona.svg.png&quot;},{&quot;name&quot;:&quot;Arkansas&quot;,&quot;flag&quot;:&quot;9/9d/Flag_of_Arkansas.svg/45px-Flag_of_Arkansas.svg.png&quot;},{&quot;name&quot;:&quot;California&quot;,&quot;flag&quot;:&quot;0/01/Flag_of_California.svg/45px-Flag_of_California.svg.png&quot;},{&quot;name&quot;:&quot;Colorado&quot;,&quot;flag&quot;:&quot;4/46/Flag_of_Colorado.svg/45px-Flag_of_Colorado.svg.png&quot;},{&quot;name&quot;:&quot;Connecticut&quot;,&quot;flag&quot;:&quot;9/96/Flag_of_Connecticut.svg/39px-Flag_of_Connecticut.svg.png&quot;},{&quot;name&quot;:&quot;Delaware&quot;,&quot;flag&quot;:&quot;c/c6/Flag_of_Delaware.svg/45px-Flag_of_Delaware.svg.png&quot;},{&quot;name&quot;:&quot;Florida&quot;,&quot;flag&quot;:&quot;f/f7/Flag_of_Florida.svg/45px-Flag_of_Florida.svg.png&quot;},{&quot;name&quot;:&quot;Georgia&quot;,&quot;flag&quot;:&quot;5/54/Flag_of_Georgia_%28U.S._state%29.svg/46px-Flag_of_Georgia_%28U.S._state%29.svg.png&quot;},{&quot;name&quot;:&quot;Hawaii&quot;,&quot;flag&quot;:&quot;e/ef/Flag_of_Hawaii.svg/46px-Flag_of_Hawaii.svg.png&quot;},{&quot;name&quot;:&quot;Idaho&quot;,&quot;flag&quot;:&quot;a/a4/Flag_of_Idaho.svg/38px-Flag_of_Idaho.svg.png&quot;},{&quot;name&quot;:&quot;Illinois&quot;,&quot;flag&quot;:&quot;0/01/Flag_of_Illinois.svg/46px-Flag_of_Illinois.svg.png&quot;},{&quot;name&quot;:&quot;Indiana&quot;,&quot;flag&quot;:&quot;a/ac/Flag_of_Indiana.svg/45px-Flag_of_Indiana.svg.png&quot;},{&quot;name&quot;:&quot;Iowa&quot;,&quot;flag&quot;:&quot;a/aa/Flag_of_Iowa.svg/44px-Flag_of_Iowa.svg.png&quot;},{&quot;name&quot;:&quot;Kansas&quot;,&quot;flag&quot;:&quot;d/da/Flag_of_Kansas.svg/46px-Flag_of_Kansas.svg.png&quot;},{&quot;name&quot;:&quot;Kentucky&quot;,&quot;flag&quot;:&quot;8/8d/Flag_of_Kentucky.svg/46px-Flag_of_Kentucky.svg.png&quot;},{&quot;name&quot;:&quot;Louisiana&quot;,&quot;flag&quot;:&quot;e/e0/Flag_of_Louisiana.svg/46px-Flag_of_Louisiana.svg.png&quot;},{&quot;name&quot;:&quot;Maine&quot;,&quot;flag&quot;:&quot;3/35/Flag_of_Maine.svg/45px-Flag_of_Maine.svg.png&quot;},{&quot;name&quot;:&quot;Maryland&quot;,&quot;flag&quot;:&quot;a/a0/Flag_of_Maryland.svg/45px-Flag_of_Maryland.svg.png&quot;},{&quot;name&quot;:&quot;Massachusetts&quot;,&quot;flag&quot;:&quot;f/f2/Flag_of_Massachusetts.svg/46px-Flag_of_Massachusetts.svg.png&quot;},{&quot;name&quot;:&quot;Michigan&quot;,&quot;flag&quot;:&quot;b/b5/Flag_of_Michigan.svg/45px-Flag_of_Michigan.svg.png&quot;},{&quot;name&quot;:&quot;Minnesota&quot;,&quot;flag&quot;:&quot;b/b9/Flag_of_Minnesota.svg/46px-Flag_of_Minnesota.svg.png&quot;},{&quot;name&quot;:&quot;Mississippi&quot;,&quot;flag&quot;:&quot;4/42/Flag_of_Mississippi.svg/45px-Flag_of_Mississippi.svg.png&quot;},{&quot;name&quot;:&quot;Missouri&quot;,&quot;flag&quot;:&quot;5/5a/Flag_of_Missouri.svg/46px-Flag_of_Missouri.svg.png&quot;},{&quot;name&quot;:&quot;Montana&quot;,&quot;flag&quot;:&quot;c/cb/Flag_of_Montana.svg/45px-Flag_of_Montana.svg.png&quot;},{&quot;name&quot;:&quot;Nebraska&quot;,&quot;flag&quot;:&quot;4/4d/Flag_of_Nebraska.svg/46px-Flag_of_Nebraska.svg.png&quot;},{&quot;name&quot;:&quot;Nevada&quot;,&quot;flag&quot;:&quot;f/f1/Flag_of_Nevada.svg/45px-Flag_of_Nevada.svg.png&quot;},{&quot;name&quot;:&quot;New Hampshire&quot;,&quot;flag&quot;:&quot;2/28/Flag_of_New_Hampshire.svg/45px-Flag_of_New_Hampshire.svg.png&quot;},{&quot;name&quot;:&quot;New Jersey&quot;,&quot;flag&quot;:&quot;9/92/Flag_of_New_Jersey.svg/45px-Flag_of_New_Jersey.svg.png&quot;},{&quot;name&quot;:&quot;New Mexico&quot;,&quot;flag&quot;:&quot;c/c3/Flag_of_New_Mexico.svg/45px-Flag_of_New_Mexico.svg.png&quot;},{&quot;name&quot;:&quot;New York&quot;,&quot;flag&quot;:&quot;1/1a/Flag_of_New_York.svg/46px-Flag_of_New_York.svg.png&quot;},{&quot;name&quot;:&quot;North Carolina&quot;,&quot;flag&quot;:&quot;b/bb/Flag_of_North_Carolina.svg/45px-Flag_of_North_Carolina.svg.png&quot;},{&quot;name&quot;:&quot;North Dakota&quot;,&quot;flag&quot;:&quot;e/ee/Flag_of_North_Dakota.svg/38px-Flag_of_North_Dakota.svg.png&quot;},{&quot;name&quot;:&quot;Ohio&quot;,&quot;flag&quot;:&quot;4/4c/Flag_of_Ohio.svg/46px-Flag_of_Ohio.svg.png&quot;},{&quot;name&quot;:&quot;Oklahoma&quot;,&quot;flag&quot;:&quot;6/6e/Flag_of_Oklahoma.svg/45px-Flag_of_Oklahoma.svg.png&quot;},{&quot;name&quot;:&quot;Oregon&quot;,&quot;flag&quot;:&quot;b/b9/Flag_of_Oregon.svg/46px-Flag_of_Oregon.svg.png&quot;},{&quot;name&quot;:&quot;Pennsylvania&quot;,&quot;flag&quot;:&quot;f/f7/Flag_of_Pennsylvania.svg/45px-Flag_of_Pennsylvania.svg.png&quot;},{&quot;name&quot;:&quot;Rhode Island&quot;,&quot;flag&quot;:&quot;f/f3/Flag_of_Rhode_Island.svg/32px-Flag_of_Rhode_Island.svg.png&quot;},{&quot;name&quot;:&quot;South Carolina&quot;,&quot;flag&quot;:&quot;6/69/Flag_of_South_Carolina.svg/45px-Flag_of_South_Carolina.svg.png&quot;},{&quot;name&quot;:&quot;South Dakota&quot;,&quot;flag&quot;:&quot;1/1a/Flag_of_South_Dakota.svg/46px-Flag_of_South_Dakota.svg.png&quot;},{&quot;name&quot;:&quot;Tennessee&quot;,&quot;flag&quot;:&quot;9/9e/Flag_of_Tennessee.svg/46px-Flag_of_Tennessee.svg.png&quot;},{&quot;name&quot;:&quot;Texas&quot;,&quot;flag&quot;:&quot;f/f7/Flag_of_Texas.svg/45px-Flag_of_Texas.svg.png&quot;},{&quot;name&quot;:&quot;Utah&quot;,&quot;flag&quot;:&quot;f/f6/Flag_of_Utah.svg/45px-Flag_of_Utah.svg.png&quot;},{&quot;name&quot;:&quot;Vermont&quot;,&quot;flag&quot;:&quot;4/49/Flag_of_Vermont.svg/46px-Flag_of_Vermont.svg.png&quot;},{&quot;name&quot;:&quot;Virginia&quot;,&quot;flag&quot;:&quot;4/47/Flag_of_Virginia.svg/44px-Flag_of_Virginia.svg.png&quot;},{&quot;name&quot;:&quot;Washington&quot;,&quot;flag&quot;:&quot;5/54/Flag_of_Washington.svg/46px-Flag_of_Washington.svg.png&quot;},{&quot;name&quot;:&quot;West Virginia&quot;,&quot;flag&quot;:&quot;2/22/Flag_of_West_Virginia.svg/46px-Flag_of_West_Virginia.svg.png&quot;},{&quot;name&quot;:&quot;Wisconsin&quot;,&quot;flag&quot;:&quot;2/22/Flag_of_Wisconsin.svg/45px-Flag_of_Wisconsin.svg.png&quot;},{&quot;name&quot;:&quot;Wyoming&quot;,&quot;flag&quot;:&quot;b/bc/Flag_of_Wyoming.svg/43px-Flag_of_Wyoming.svg.png&quot;}];
}</code></pre>
                    </div>
                  </tab>
                </tabset>
              </div>
            </div>
          </section>
          <script>function TypeaheadCtrl($scope, $http) {

  $scope.selected = undefined;
  $scope.states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Dakota', 'North Carolina', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'];
  // Any function returning a promise object can be used to load values asynchronously
  $scope.getLocation = function(val) {
    return $http.get('http://maps.googleapis.com/maps/api/geocode/json', {
      params: {
        address: val,
        sensor: false
      }
    }).then(function(res){
      var addresses = [];
      angular.forEach(res.data.results, function(item){
        addresses.push(item.formatted_address);
      });
      return addresses;
    });
  };

  $scope.statesWithFlags = [{"name":"Alabama","flag":"5/5c/Flag_of_Alabama.svg/45px-Flag_of_Alabama.svg.png"},{"name":"Alaska","flag":"e/e6/Flag_of_Alaska.svg/43px-Flag_of_Alaska.svg.png"},{"name":"Arizona","flag":"9/9d/Flag_of_Arizona.svg/45px-Flag_of_Arizona.svg.png"},{"name":"Arkansas","flag":"9/9d/Flag_of_Arkansas.svg/45px-Flag_of_Arkansas.svg.png"},{"name":"California","flag":"0/01/Flag_of_California.svg/45px-Flag_of_California.svg.png"},{"name":"Colorado","flag":"4/46/Flag_of_Colorado.svg/45px-Flag_of_Colorado.svg.png"},{"name":"Connecticut","flag":"9/96/Flag_of_Connecticut.svg/39px-Flag_of_Connecticut.svg.png"},{"name":"Delaware","flag":"c/c6/Flag_of_Delaware.svg/45px-Flag_of_Delaware.svg.png"},{"name":"Florida","flag":"f/f7/Flag_of_Florida.svg/45px-Flag_of_Florida.svg.png"},{"name":"Georgia","flag":"5/54/Flag_of_Georgia_%28U.S._state%29.svg/46px-Flag_of_Georgia_%28U.S._state%29.svg.png"},{"name":"Hawaii","flag":"e/ef/Flag_of_Hawaii.svg/46px-Flag_of_Hawaii.svg.png"},{"name":"Idaho","flag":"a/a4/Flag_of_Idaho.svg/38px-Flag_of_Idaho.svg.png"},{"name":"Illinois","flag":"0/01/Flag_of_Illinois.svg/46px-Flag_of_Illinois.svg.png"},{"name":"Indiana","flag":"a/ac/Flag_of_Indiana.svg/45px-Flag_of_Indiana.svg.png"},{"name":"Iowa","flag":"a/aa/Flag_of_Iowa.svg/44px-Flag_of_Iowa.svg.png"},{"name":"Kansas","flag":"d/da/Flag_of_Kansas.svg/46px-Flag_of_Kansas.svg.png"},{"name":"Kentucky","flag":"8/8d/Flag_of_Kentucky.svg/46px-Flag_of_Kentucky.svg.png"},{"name":"Louisiana","flag":"e/e0/Flag_of_Louisiana.svg/46px-Flag_of_Louisiana.svg.png"},{"name":"Maine","flag":"3/35/Flag_of_Maine.svg/45px-Flag_of_Maine.svg.png"},{"name":"Maryland","flag":"a/a0/Flag_of_Maryland.svg/45px-Flag_of_Maryland.svg.png"},{"name":"Massachusetts","flag":"f/f2/Flag_of_Massachusetts.svg/46px-Flag_of_Massachusetts.svg.png"},{"name":"Michigan","flag":"b/b5/Flag_of_Michigan.svg/45px-Flag_of_Michigan.svg.png"},{"name":"Minnesota","flag":"b/b9/Flag_of_Minnesota.svg/46px-Flag_of_Minnesota.svg.png"},{"name":"Mississippi","flag":"4/42/Flag_of_Mississippi.svg/45px-Flag_of_Mississippi.svg.png"},{"name":"Missouri","flag":"5/5a/Flag_of_Missouri.svg/46px-Flag_of_Missouri.svg.png"},{"name":"Montana","flag":"c/cb/Flag_of_Montana.svg/45px-Flag_of_Montana.svg.png"},{"name":"Nebraska","flag":"4/4d/Flag_of_Nebraska.svg/46px-Flag_of_Nebraska.svg.png"},{"name":"Nevada","flag":"f/f1/Flag_of_Nevada.svg/45px-Flag_of_Nevada.svg.png"},{"name":"New Hampshire","flag":"2/28/Flag_of_New_Hampshire.svg/45px-Flag_of_New_Hampshire.svg.png"},{"name":"New Jersey","flag":"9/92/Flag_of_New_Jersey.svg/45px-Flag_of_New_Jersey.svg.png"},{"name":"New Mexico","flag":"c/c3/Flag_of_New_Mexico.svg/45px-Flag_of_New_Mexico.svg.png"},{"name":"New York","flag":"1/1a/Flag_of_New_York.svg/46px-Flag_of_New_York.svg.png"},{"name":"North Carolina","flag":"b/bb/Flag_of_North_Carolina.svg/45px-Flag_of_North_Carolina.svg.png"},{"name":"North Dakota","flag":"e/ee/Flag_of_North_Dakota.svg/38px-Flag_of_North_Dakota.svg.png"},{"name":"Ohio","flag":"4/4c/Flag_of_Ohio.svg/46px-Flag_of_Ohio.svg.png"},{"name":"Oklahoma","flag":"6/6e/Flag_of_Oklahoma.svg/45px-Flag_of_Oklahoma.svg.png"},{"name":"Oregon","flag":"b/b9/Flag_of_Oregon.svg/46px-Flag_of_Oregon.svg.png"},{"name":"Pennsylvania","flag":"f/f7/Flag_of_Pennsylvania.svg/45px-Flag_of_Pennsylvania.svg.png"},{"name":"Rhode Island","flag":"f/f3/Flag_of_Rhode_Island.svg/32px-Flag_of_Rhode_Island.svg.png"},{"name":"South Carolina","flag":"6/69/Flag_of_South_Carolina.svg/45px-Flag_of_South_Carolina.svg.png"},{"name":"South Dakota","flag":"1/1a/Flag_of_South_Dakota.svg/46px-Flag_of_South_Dakota.svg.png"},{"name":"Tennessee","flag":"9/9e/Flag_of_Tennessee.svg/46px-Flag_of_Tennessee.svg.png"},{"name":"Texas","flag":"f/f7/Flag_of_Texas.svg/45px-Flag_of_Texas.svg.png"},{"name":"Utah","flag":"f/f6/Flag_of_Utah.svg/45px-Flag_of_Utah.svg.png"},{"name":"Vermont","flag":"4/49/Flag_of_Vermont.svg/46px-Flag_of_Vermont.svg.png"},{"name":"Virginia","flag":"4/47/Flag_of_Virginia.svg/44px-Flag_of_Virginia.svg.png"},{"name":"Washington","flag":"5/54/Flag_of_Washington.svg/46px-Flag_of_Washington.svg.png"},{"name":"West Virginia","flag":"2/22/Flag_of_West_Virginia.svg/46px-Flag_of_West_Virginia.svg.png"},{"name":"Wisconsin","flag":"2/22/Flag_of_Wisconsin.svg/45px-Flag_of_Wisconsin.svg.png"},{"name":"Wyoming","flag":"b/bc/Flag_of_Wyoming.svg/43px-Flag_of_Wyoming.svg.png"}];
}</script>
        
        <section id="animations">
          <div class="page-header">
            <h1>Animations</h1>
            <p>Foundation includes animations in its JavaScript files but
            the components above don't use Foundation's JavaScript.
            You can use the official Angular module ngAnimate in your project
            or simple CSS animations like the example below.</p>
          </div>
          <div class="row">
            <div class="columns medium-12">
            </div>
          </div>
          <hr>
          <div class="row code">
            <div class="columns medium-12">
              <pre><code data-language="css">.fade {
  opacity: 0;
  -webkit-transition: opacity .15s linear;
          transition: opacity .15s linear;
}
.fade.in {
  opacity: 1;
}

.reveal-modal.fade {
  -webkit-transition: -webkit-transform .3s ease-out;
     -moz-transition:    -moz-transform .3s ease-out;
       -o-transition:      -o-transform .3s ease-out;
          transition:         transform .3s ease-out;
  -webkit-transform: translate(0, -25%);
      -ms-transform: translate(0, -25%);
          transform: translate(0, -25%);
}
.reveal-modal.in {
  -webkit-transform: translate(0, 0);
      -ms-transform: translate(0, 0);
          transform: translate(0, 0);
}

.reveal-modal-bg.fade {
  filter: alpha(opacity=0);
  opacity: 0;
}
.reveal-modal-bg.in {
  filter: alpha(opacity=50);
  opacity: .5;
}</code></pre>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div><!-- /.container -->
</div><!-- /.main -->
<footer class="footer">
  <div class="container">
    <p>Code licensed under <a href="https://github.com/pineconellc/angular-foundation/blob/master/LICENSE">MIT License</a>.</p>
    <p><a href="https://github.com/pineconellc/angular-foundation/issues?state=open">Issues</a></p>
  </div>
</footer>
<script src="<?php echo ASSET_URL; ?>/js/ang/rainbow.js"></script>
<script src="<?php echo ASSET_URL; ?>/js/ang/rainbow-generic.js"></script>
<script src="<?php echo ASSET_URL; ?>/js/ang/rainbow-javascript.js"></script>
<script src="<?php echo ASSET_URL; ?>/js/ang/rainbow-html.js"></script>
<script type="text/ng-template" id="downloadModal.html">
  <div class="modal-header"><h4 class="modal-title">Download Angular UI Bootstrap</h4></div>
  <div class="modal-body">
    <form class="form-horizontal">
      <div class="form-group">
        <label class="col-sm-3 control-label"><strong>Build</strong></label>
        <div class="col-sm-9">
          <span class="button-group">
            <button type="button" class="button" ng-model="options.minified" btn-radio="true">Minified</button>
            <button type="button" class="button" ng-model="options.minified" btn-radio="false">Uncompressed</button>
          </span>
          <small class="help-block">Use <b>Minified</b> version in your deployed application. <b>Uncompressed</b> source code is useful only for debugging and development purpose.</small>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label"><strong>Include Templates</strong></label>
        <div class="col-sm-9">
          <span class="button-group">
            <button type="button" class="button" ng-model="options.tpls" btn-radio="true">Yes</button>
            <button type="button" class="button" ng-model="options.tpls" btn-radio="false">No</button>
          </span>
          <small class="help-block">Whether you want to include the <i>default templates</i>, bundled with most of the directives. These templates are based on Bootstrap's markup and CSS.</small>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label"><strong>Bower</strong></label>
        <div class="col-sm-9">
          <small>If you are using Bower just run:</small>
          <pre>bower install angular-foundation</pre>
          <small class="help-block"><a href="http://bower.io/" target="_blank">Bower</a> is a package manager for the web.</small>
        </div>
      </div>
    </form>
  </div>
  <div class="modal-footer">
    <a class="button" ng-click="cancel()">Cancel</a>
    <a class="button" ng-click="download('0.3.1')"><i class="fa fa-download"></i> Download 0.3.1</a>
  </div>
</script>

<script src="<?php echo ASSET_URL; ?>/js/ang/smoothscroll-angular-custom.js"></script>
</body>
</html>