<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <title>Visit Notes</title>
    <meta charset="UTF-8">
    <style>
    :root {
        --blue: #007bff;
        --indigo: #6610f2;
        --purple: #6f42c1;
        --pink: #e83e8c;
        --red: #dc3545;
        --orange: #fd7e14;
        --yellow: #ffc107;
        --green: #28a745;
        --teal: #20c997;
        --cyan: #17a2b8;
        --white: #fff;
        --gray: #6c757d;
        --gray-dark: #343a40;
        --primary: #007bff;
        --secondary: #6c757d;
        --success: #28a745;
        --info: #17a2b8;
        --warning: #ffc107;
        --danger: #dc3545;
        --light: #f8f9fa;
        --dark: #343a40;
        --breakpoint-xs: 0;
        --breakpoint-sm: 576px;
        --breakpoint-md: 768px;
        --breakpoint-lg: 992px;
        --breakpoint-xl: 1200px;
        --font-family-sans-serif: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        --font-family-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace
    }

    *,
    ::after,
    ::before {
        box-sizing: border-box
    }

    html {
        font-family: sans-serif;
        line-height: 1.15;
        -webkit-text-size-adjust: 100%;
        -webkit-tap-highlight-color: transparent
    }

    body {
        margin: 0;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        text-align: left;
        background-color: #fff
    }

    hr {
        box-sizing: content-box;
        height: 0;
        overflow: visible
    }

    .bg-primary {
        background-color: #007bff !important
    }

    .w-25 {
        width: 25% !important
    }

    .w-50 {
        width: 50% !important
    }

    .w-75 {
        width: 75% !important
    }

    .w-100 {
        width: 100% !important
    }

    .w-auto {
        width: auto !important
    }

    .h-25 {
        height: 25% !important
    }

    .h-50 {
        height: 50% !important
    }

    .h-75 {
        height: 75% !important
    }

    .h-100 {
        height: 100% !important
    }

    .h-auto {
        height: auto !important
    }

    .mw-100 {
        max-width: 100% !important
    }

    .mh-100 {
        max-height: 100% !important
    }

    .min-vw-100 {
        min-width: 100vw !important
    }

    .min-vh-100 {
        min-height: 100vh !important
    }

    .vw-100 {
        width: 100vw !important
    }

    .vh-100 {
        height: 100vh !important
    }

    .m-0 {
        margin: 0 !important
    }

    .mt-0,
    .my-0 {
        margin-top: 0 !important
    }

    .mr-0,
    .mx-0 {
        margin-right: 0 !important
    }

    .mb-0,
    .my-0 {
        margin-bottom: 0 !important
    }

    .ml-0,
    .mx-0 {
        margin-left: 0 !important
    }

    .m-1 {
        margin: .25rem !important
    }

    .mt-1,
    .my-1 {
        margin-top: .25rem !important
    }

    .mr-1,
    .mx-1 {
        margin-right: .25rem !important
    }

    .mb-1,
    .my-1 {
        margin-bottom: .25rem !important
    }

    .ml-1,
    .mx-1 {
        margin-left: .25rem !important
    }

    .m-2 {
        margin: .5rem !important
    }

    .mt-2,
    .my-2 {
        margin-top: .5rem !important
    }

    .mr-2,
    .mx-2 {
        margin-right: .5rem !important
    }

    .mb-2,
    .my-2 {
        margin-bottom: .5rem !important
    }

    .ml-2,
    .mx-2 {
        margin-left: .5rem !important
    }

    .m-3 {
        margin: 1rem !important
    }

    .mt-3,
    .my-3 {
        margin-top: 1rem !important
    }

    .mr-3,
    .mx-3 {
        margin-right: 1rem !important
    }

    .mb-3,
    .my-3 {
        margin-bottom: 1rem !important
    }

    .ml-3,
    .mx-3 {
        margin-left: 1rem !important
    }

    .m-4 {
        margin: 1.5rem !important
    }

    .mt-4,
    .my-4 {
        margin-top: 1.5rem !important
    }

    .mr-4,
    .mx-4 {
        margin-right: 1.5rem !important
    }

    .mb-4,
    .my-4 {
        margin-bottom: 1.5rem !important
    }

    .ml-4,
    .mx-4 {
        margin-left: 1.5rem !important
    }

    .m-5 {
        margin: 3rem !important
    }

    .mt-5,
    .my-5 {
        margin-top: 3rem !important
    }

    .mr-5,
    .mx-5 {
        margin-right: 3rem !important
    }

    .mb-5,
    .my-5 {
        margin-bottom: 3rem !important
    }

    .ml-5,
    .mx-5 {
        margin-left: 3rem !important
    }

    .p-0 {
        padding: 0 !important
    }

    .pt-0,
    .py-0 {
        padding-top: 0 !important
    }

    .pr-0,
    .px-0 {
        padding-right: 0 !important
    }

    .pb-0,
    .py-0 {
        padding-bottom: 0 !important
    }

    .pl-0,
    .px-0 {
        padding-left: 0 !important
    }

    .p-1 {
        padding: .25rem !important
    }

    .pt-1,
    .py-1 {
        padding-top: .25rem !important
    }

    .pr-1,
    .px-1 {
        padding-right: .25rem !important
    }

    .pb-1,
    .py-1 {
        padding-bottom: .25rem !important
    }

    .pl-1,
    .px-1 {
        padding-left: .25rem !important
    }

    .p-2 {
        padding: .5rem !important
    }

    .pt-2,
    .py-2 {
        padding-top: .5rem !important
    }

    .pr-2,
    .px-2 {
        padding-right: .5rem !important
    }

    .pb-2,
    .py-2 {
        padding-bottom: .5rem !important
    }

    .pl-2,
    .px-2 {
        padding-left: .5rem !important
    }

    .p-3 {
        padding: 1rem !important
    }

    .pt-3,
    .py-3 {
        padding-top: 1rem !important
    }

    .pr-3,
    .px-3 {
        padding-right: 1rem !important
    }

    .pb-3,
    .py-3 {
        padding-bottom: 1rem !important
    }

    .pl-3,
    .px-3 {
        padding-left: 1rem !important
    }

    .p-4 {
        padding: 1.5rem !important
    }

    .pt-4,
    .py-4 {
        padding-top: 1.5rem !important
    }

    .pr-4,
    .px-4 {
        padding-right: 1.5rem !important
    }

    .pb-4,
    .py-4 {
        padding-bottom: 1.5rem !important
    }

    .pl-4,
    .px-4 {
        padding-left: 1.5rem !important
    }

    .p-5 {
        padding: 3rem !important
    }

    .pt-5,
    .py-5 {
        padding-top: 3rem !important
    }

    .pr-5,
    .px-5 {
        padding-right: 3rem !important
    }

    .pb-5,
    .py-5 {
        padding-bottom: 3rem !important
    }

    .pl-5,
    .px-5 {
        padding-left: 3rem !important
    }

    .m-n1 {
        margin: -.25rem !important
    }

    .mt-n1,
    .my-n1 {
        margin-top: -.25rem !important
    }

    .mr-n1,
    .mx-n1 {
        margin-right: -.25rem !important
    }

    .mb-n1,
    .my-n1 {
        margin-bottom: -.25rem !important
    }

    .ml-n1,
    .mx-n1 {
        margin-left: -.25rem !important
    }

    .m-n2 {
        margin: -.5rem !important
    }

    .mt-n2,
    .my-n2 {
        margin-top: -.5rem !important
    }

    .mr-n2,
    .mx-n2 {
        margin-right: -.5rem !important
    }

    .mb-n2,
    .my-n2 {
        margin-bottom: -.5rem !important
    }

    .ml-n2,
    .mx-n2 {
        margin-left: -.5rem !important
    }

    .m-n3 {
        margin: -1rem !important
    }

    .mt-n3,
    .my-n3 {
        margin-top: -1rem !important
    }

    .mr-n3,
    .mx-n3 {
        margin-right: -1rem !important
    }

    .mb-n3,
    .my-n3 {
        margin-bottom: -1rem !important
    }

    .ml-n3,
    .mx-n3 {
        margin-left: -1rem !important
    }

    .m-n4 {
        margin: -1.5rem !important
    }

    .mt-n4,
    .my-n4 {
        margin-top: -1.5rem !important
    }

    .mr-n4,
    .mx-n4 {
        margin-right: -1.5rem !important
    }

    .mb-n4,
    .my-n4 {
        margin-bottom: -1.5rem !important
    }

    .ml-n4,
    .mx-n4 {
        margin-left: -1.5rem !important
    }

    .m-n5 {
        margin: -3rem !important
    }

    .mt-n5,
    .my-n5 {
        margin-top: -3rem !important
    }

    .mr-n5,
    .mx-n5 {
        margin-right: -3rem !important
    }

    .mb-n5,
    .my-n5 {
        margin-bottom: -3rem !important
    }

    .ml-n5,
    .mx-n5 {
        margin-left: -3rem !important
    }

    .m-auto {
        margin: auto !important
    }

    .mt-auto,
    .my-auto {
        margin-top: auto !important
    }

    .mr-auto,
    .mx-auto {
        margin-right: auto !important
    }

    .mb-auto,
    .my-auto {
        margin-bottom: auto !important
    }

    .ml-auto,
    .mx-auto {
        margin-left: auto !important
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin-top: 0;
        margin-bottom: .5rem
    }

    table {
        border-collapse: collapse
    }

    th {
        text-align: inherit
    }

    hr {
        margin-top: 1rem;
        margin-bottom: 1rem;
        border: 0;
        border-top: 1px solid rgba(0, 0, 0, .1)
    }

    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529
    }

    .table td,
    .table th {
        padding: .75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6
    }

    .table tbody+tbody {
        border-top: 2px solid #dee2e6
    }

    .table-sm td,
    .table-sm th {
        padding: .3rem
    }

    .table-bordered {
        border: 1px solid #dee2e6
    }

    .table-bordered td,
    .table-bordered th {
        border: 1px solid #dee2e6
    }

    .table-bordered thead td,
    .table-bordered thead th {
        border-bottom-width: 2px
    }

    .table-borderless tbody+tbody,
    .table-borderless td,
    .table-borderless th,
    .table-borderless thead th {
        border: 0
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, .05)
    }

    .table-hover tbody tr:hover {
        color: #212529;
        background-color: rgba(0, 0, 0, .075)
    }

    .table-primary,
    .table-primary>td,
    .table-primary>th {
        background-color: #b8daff
    }

    .table-primary tbody+tbody,
    .table-primary td,
    .table-primary th,
    .table-primary thead th {
        border-color: #7abaff
    }

    .table-hover .table-primary:hover {
        background-color: #9fcdff
    }

    .table-hover .table-primary:hover>td,
    .table-hover .table-primary:hover>th {
        background-color: #9fcdff
    }

    .table-secondary,
    .table-secondary>td,
    .table-secondary>th {
        background-color: #d6d8db
    }

    .table-secondary tbody+tbody,
    .table-secondary td,
    .table-secondary th,
    .table-secondary thead th {
        border-color: #b3b7bb
    }

    .table-hover .table-secondary:hover {
        background-color: #c8cbcf
    }

    .table-hover .table-secondary:hover>td,
    .table-hover .table-secondary:hover>th {
        background-color: #c8cbcf
    }

    .table-success,
    .table-success>td,
    .table-success>th {
        background-color: #c3e6cb
    }

    .table-success tbody+tbody,
    .table-success td,
    .table-success th,
    .table-success thead th {
        border-color: #8fd19e
    }

    .table-hover .table-success:hover {
        background-color: #b1dfbb
    }

    .table-hover .table-success:hover>td,
    .table-hover .table-success:hover>th {
        background-color: #b1dfbb
    }

    .table-info,
    .table-info>td,
    .table-info>th {
        background-color: #bee5eb
    }

    .table-info tbody+tbody,
    .table-info td,
    .table-info th,
    .table-info thead th {
        border-color: #86cfda
    }

    .table-hover .table-info:hover {
        background-color: #abdde5
    }

    .table-hover .table-info:hover>td,
    .table-hover .table-info:hover>th {
        background-color: #abdde5
    }

    .table-warning,
    .table-warning>td,
    .table-warning>th {
        background-color: #ffeeba
    }

    .table-warning tbody+tbody,
    .table-warning td,
    .table-warning th,
    .table-warning thead th {
        border-color: #ffdf7e
    }

    .table-hover .table-warning:hover {
        background-color: #ffe8a1
    }

    .table-hover .table-warning:hover>td,
    .table-hover .table-warning:hover>th {
        background-color: #ffe8a1
    }

    .table-danger,
    .table-danger>td,
    .table-danger>th {
        background-color: #f5c6cb
    }

    .table-danger tbody+tbody,
    .table-danger td,
    .table-danger th,
    .table-danger thead th {
        border-color: #ed969e
    }

    .table-hover .table-danger:hover {
        background-color: #f1b0b7
    }

    .table-hover .table-danger:hover>td,
    .table-hover .table-danger:hover>th {
        background-color: #f1b0b7
    }

    .table-light,
    .table-light>td,
    .table-light>th {
        background-color: #fdfdfe
    }

    .table-light tbody+tbody,
    .table-light td,
    .table-light th,
    .table-light thead th {
        border-color: #fbfcfc
    }

    .table-hover .table-light:hover {
        background-color: #ececf6
    }

    .table-hover .table-light:hover>td,
    .table-hover .table-light:hover>th {
        background-color: #ececf6
    }

    .table-dark,
    .table-dark>td,
    .table-dark>th {
        background-color: #c6c8ca
    }

    .table-dark tbody+tbody,
    .table-dark td,
    .table-dark th,
    .table-dark thead th {
        border-color: #95999c
    }

    .table-hover .table-dark:hover {
        background-color: #b9bbbe
    }

    .table-hover .table-dark:hover>td,
    .table-hover .table-dark:hover>th {
        background-color: #b9bbbe
    }

    .table-active,
    .table-active>td,
    .table-active>th {
        background-color: rgba(0, 0, 0, .075)
    }

    .table-hover .table-active:hover {
        background-color: rgba(0, 0, 0, .075)
    }

    .table-hover .table-active:hover>td,
    .table-hover .table-active:hover>th {
        background-color: rgba(0, 0, 0, .075)
    }

    .table .thead-dark th {
        color: #fff;
        background-color: #343a40;
        border-color: #454d55
    }

    .table .thead-light th {
        color: #495057;
        background-color: #e9ecef;
        border-color: #dee2e6
    }

    .table-dark {
        color: #fff;
        background-color: #343a40
    }

    .table-dark td,
    .table-dark th,
    .table-dark thead th {
        border-color: #454d55
    }

    .table-dark.table-bordered {
        border: 0
    }

    .table-dark.table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(255, 255, 255, .05)
    }

    .table-dark.table-hover tbody tr:hover {
        color: #fff;
        background-color: rgba(255, 255, 255, .075)
    }

    .text-primary {
        color: #007bff !important
    }

    .text-white {
        color: #fff !important
    }

    .text-danger {
        color: #dc3545 !important
    }

    .text-left {
        text-align: left !important
    }

    .text-right {
        text-align: right !important
    }

    .text-center {
        text-align: center !important
    }

    @page {
        margin: 20px 10px
    }

    body {
        margin: 10px 10px 55px 10px;
    }

    body {
        font-family: Quicksand, sans-serif
    }

    .header {
        background-color: #b2d0f8;
        color: #000;
        font-family: Quicksand, sans-serif;
        font-size: 1em;
        padding-left: 5px;
        font-weight: 600
    }

    .lineheight {
        line-height: 9px;
        font-size: 11px
    }

    .subheaders {
        line-height: 10px;
        font-family: Quicksand, sans-serif;
        font-weight: 700;
        font-size: 11px
    }

    .subtext {
        font-family: Quicksand, sans-serif;
        font-size: 12px;
        color: #000
    }

    .margintopbottom {
        margin-top: .1em !important;
        margin-bottom: .1em !important
    }

    .dots {
        background:url('{{$_SERVER["DOCUMENT_ROOT"] . "/img/dot.gif"}}') repeat-x bottom;
    }

    .field {
        background-color: #fff
    }

    .field1 {
        background-color: #e8eef8
    }

    .nowrap {
        white-space: nowrap
    }

    footer {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        height: 30px;
        font-size: 10px;
        border-top: 1px solid #6C757D;
        color: #6C757D;
    }

    strong {
        font-weight: bolder
    }

    .h1,
    h1 {
        font-size: 2.5rem
    }

    .h2,
    h2 {
        font-size: 2rem
    }

    .h3,
    h3 {
        font-size: 1.75rem
    }

    .h4,
    h4 {
        font-size: 1.5rem
    }

    .h5,
    h5 {
        font-size: 1.25rem
    }

    .h6,
    h6 {
        font-size: 1rem
    }

    #pageFooter:after {
        counter-increment: page;
        content: "(Page "calc(counter(page) / 2) ")";
        top: 100%;
        white-space: nowrap;
        z-index: 20;
        -moz-border-radius: 5px;
        -moz-box-shadow: 0px 0px 4px #222;
        background-image: -moz-linear-gradient(top, #eeeeee, #cccccc);
    }
    </style>
</head>

<body>
    <div style="position: fixed;bottom:0;left:0;right:0;height:50px;font-size:10px; color: #6C757D;" class="w-100">
        Electronically Signed by: {{$visit->first()->addedby->firstname . ' ' . $visit->first()->addedby->lastname}}
        <!--<span class="text-right" id="pageFooter"></span>-->
    </div>
    <footer>
        PATIENT NAME: {{$visit->first()->patient->FirstName . ' ' . $visit->first()->patient->LastName}} | DOS:
        {{$visit->first()->DOS}} |
        FACILITY: {{$visit->first()->FacilityName}}
    </footer>
    <table style="width:100%;">
        <tr>
            <td style="width:50%; text-align: left;">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAAArCAYAAAA9iMeyAAAACXBIWXMAAC4jAAAuIwF4pT92AAAFFmlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNi4wLWMwMDIgNzkuMTY0NDg4LCAyMDIwLzA3LzEwLTIyOjA2OjUzICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1sbnM6cGhvdG9zaG9wPSJodHRwOi8vbnMuYWRvYmUuY29tL3Bob3Rvc2hvcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgMjIuMCAoV2luZG93cykiIHhtcDpDcmVhdGVEYXRlPSIyMDIxLTA1LTAzVDExOjI3OjUzLTA0OjAwIiB4bXA6TW9kaWZ5RGF0ZT0iMjAyMS0wNS0wM1QxMToyODoxOC0wNDowMCIgeG1wOk1ldGFkYXRhRGF0ZT0iMjAyMS0wNS0wM1QxMToyODoxOC0wNDowMCIgZGM6Zm9ybWF0PSJpbWFnZS9wbmciIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDphZDkwZmRjNS0wNGVmLTgw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"
                    style="width: 150px; margin-top: -15px;" />
                <span class="bluecolor" style="font-size:1em; color: #000; font-weight: 600; margin-top: -10px;"> -
                    {{$visit->first()->addedby->firstname . ' ' . $visit->first()->addedby->lastname}}</span>
            </td>
            <td style="width:50%; text-align: right; line-height: 18px; font-size:1.2em; font-weight: 600;">
                <span class="text-primary">PROGRESS NOTES</span>
                <div class="subtext">
                    DOS: {{$visit->first()->DOS}}
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <hr class="bg-primary margintopbottom">
            </td>
        </tr>
        <tr>
            <td colspan="2" class='bg-primary pt-0 text-white'>
                Patient
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <hr class="bg-primary margintopbottom">
            </td>
        </tr>
        <tr style="background-color: #e8eef8;">
            <td class="p-1 w-50">
                <table style='width: 100%;' cellpadding="0">
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field1">Name</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->patient->FirstName . ' ' . $visit->first()->patient->LastName}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field1">DOB</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->patient->DOB}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field1">Gender</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->patient->Gender == "" ? "" :
                                ($visit->first()->patient->Gender == 'M' ? "Male" : 
                                ($visit->first()->patient->Gender == "U" ? "Unknown" : 
                                ($visit->first()->patient->Gender == "F" ? "Female" : "")))}}
                        </td>
                    </tr>
                    @if(!empty($visit->first()->patient->Language))
                    <tr>
                        <td class='subheaders pl-1 pt-1 pb-1 pr-0 w-100'>
                            <div class='dots'>
                                <span class='field1'>Language</span>
                            </div>
                        </td>
                        <td class='lineheight nowrap'>
                            @if($visit->first()->patient->Language == "eng")
                            English
                            @elseif($visit->first()->patient->Language == "spa")
                            Spanish
                            @elseif($visit->first()->patient->Language == "fr")
                            French
                            @elseif($visit->first()->patient->Language == "zh")
                            Chinese
                            @elseif($visit->first()->patient->Language == "de")
                            German
                            @elseif($visit->first()->patient->Language == "ja")
                            Japanese
                            @elseif($visit->first()->patient->Language == "ko")
                            Korean
                            @elseif($visit->first()->patient->Language == "999")
                            Other
                            @elseif($visit->first()->patient->Language == "asku")
                            Patient Declined
                            @endif
                        </td>
                    </tr>
                    @endif
                    @if(!empty($visit->first()->patient->Religion))
                    <tr>
                        <td class='subheaders pl-1 pt-1 pb-1 pr-0 w-100'>
                            <div class='dots'>
                                <span class='field1'>Religion</span>
                            </div>
                        </td>
                        <td class='lineheight nowrap'>
                            @if($visit->first()->patient->Religion == "1002-5")
                            American Indian or Alaska Native
                            @elseif($visit->first()->patient->Religion == "2028-9")
                            Asian
                            @elseif($visit->first()->patient->Religion == "22054-5")
                            Black or African American
                            @elseif($visit->first()->patient->Religion == "2076-8")
                            Native Hawaiian or Other Pacific Islander
                            @elseif($visit->first()->patient->Religion == "2106-3")
                            White
                            @endif
                        </td>
                    </tr>
                    @endif
                    @if(!empty($visit->first()->patient->SexualOrientation))
                    <tr>
                        <td class='subheaders pl-1 pt-1 pb-1 pr-0 w-100'>
                            <div class='dots'>
                                <span class='field1'>Sexual Orientation</span>
                            </div>
                        </td>
                        <td class='lineheight nowrap'>
                            @if($visit->first()->patient->SexualOrientation == "1")
                            Bisexual
                            @elseif($visit->first()->patient->SexualOrientation == "2")
                            Choose not to Disclose
                            @elseif($visit->first()->patient->SexualOrientation == "3")
                            Lesbian or Gay or Homose
                            @elseif($visit->first()->patient->SexualOrientation == "4")
                            Other
                            @elseif($visit->first()->patient->SexualOrientation == "5")
                            Straight or Hetrosexual
                            @elseif($visit->first()->patient->SexualOrientation == "6")
                            Unknown
                            @endif
                        </td>
                    </tr>
                    @endif
                </table>
            </td>
            <td style='vertical-align: top;' class="p-1">
                <table style='width: 100%;' cellpadding="5">
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field1">Facility</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->FacilityName}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <br>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="subheaders m-1 p-1">
                <h6 class="text-primary mb-0"><strong>Chief Complaint</strong></h6>
            </td>
        </tr>
        <tr>
            <td class="header" colspan="2"></td>
        </tr>
        <tr>
            <td style="font-size: 12px;" colspan="2">
                For general, {{$visit->first()->chiefcomplaint->General}}. he reports minimal pain noted as per staff /
                patient, associates signs and symptoms as per chart / staff.
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <br>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="subheaders m-1 p-1">
                <h6 class="text-primary mb-0"><strong>History</strong></h6>
            </td>
        </tr>
        <tr>
            <td class="header" colspan="2"></td>
        </tr>
        <tr>
            <td colspan="2">

            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span class="subheaders">HPI Description: </span>
                <span class="lineheight">
                    {{$visit->first()->HPIDescription}}
                </span>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span class="subheaders">Healing Delayed By: </span>
                <span class="lineheight">
                    {{$visit->first()->HealingDelayedBy}}
                </span>
            </td>
        </tr>
        <tr>
            <td>
                <table style='width: 100%;'>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Place of Service</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->PlaceofService}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Date of Admission</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->DateofAdmission}}
                        </td>
                    </tr>

                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Ambulatory</span>
                            </div>
                        </td>
                        <td class="lineheight">
                            {{$visit->first()->Aid}}
                        </td>
                    </tr>

                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Foot Measurement</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->ShoeSize}}
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <table style='width: 100%;'>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Is Hospice</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->Hospice == 1 ? "Yes" : "No"}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Fall Risk Assesment</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->FallRisk == "1" ? "Yes" : "No"}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Falls Type</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->FallsType}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field"># of Falls</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->TotalFalls}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Is Diabetic</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->IsDiabetic == "0" ? "No" : "Yes"}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Sensation to BLE?</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->ExamSensation}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <br>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="subheaders m-1 p-1">
                <h6 class="text-primary mb-0"><strong>Examination</strong></h6>
            </td>
        </tr>
        <tr>
            <td class="header" colspan="2"></td>
        </tr>
        <tr>
            <td class="w-50" style="vertical-align: top;">
                <table style="width: 100%;">
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 text-primary" colspan="2">
                            VITALS
                        </td>

                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Height</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{!empty($visit->first()->vital) ? $visit->first()->vital->HeightFeet . "'" . (int)($visit->first()->vital->HeightInches) . "''" : ""}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Weight</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{!empty($visit->first()->vital) ? $visit->first()->vital->Weight . "lbs" : ""}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">BP</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{!empty($visit->first()->vital) ? $visit->first()->vital->BPSystolic . "/" . $visit->first()->vital->BPDiastolic : ""}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Temperature</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{!empty($visit->first()->vital) ? $visit->first()->vital->Temperature : ""}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Pulse</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{!empty($visit->first()->vital) ? $visit->first()->vital->Pulse : ""}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Respiratory</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{!empty($visit->first()->vital) ? $visit->first()->vital->Resp : ""}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 text-primary">
                            PULSES
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Radial Pulses</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            @if(!empty($visit->first()->PulseRLE))
                            @foreach(explode(",", $visit->first()->PulseRLE) as $p)
                            @if(Str::contains($p, "RadialPulseRLE"))
                            RLE: {{Str::replace("RadialPulseRLE", "", $p)}}
                            @endif
                            @endforeach
                            @endif
                            @if(!empty($visit->first()->PulseLLE))
                            @foreach(explode(",", $visit->first()->PulseLLE) as $p)
                            @if(Str::contains($p, "RadialPulseLLE"))
                            LLE: {{Str::replace("RadialPulseLLE", "", $p)}}
                            @endif
                            @endforeach
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Dorsalis Pulses</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            @if(!empty($visit->first()->PulseRLE))
                            @foreach(explode(",", $visit->first()->PulseRLE) as $p)
                            @if(Str::contains($p, "DorsalisPedisRLE"))
                            RLE: {{Str::replace("DorsalisPedisRLE", "", $p)}}
                            @endif
                            @endforeach
                            @endif
                            @if(!empty($visit->first()->PulseLLE))
                            @foreach(explode(",", $visit->first()->PulseLLE) as $p)
                            @if(Str::contains($p, "DorsalisPedisLLE"))
                            LLE: {{Str::replace("DorsalisPedisLLE", "", $p)}}
                            @endif
                            @endforeach
                            @endif
                        </td>

                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Edema</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            @if(!empty($visit->first()->PulseRLE))
                            @foreach(explode(",", $visit->first()->PulseRLE) as $p)
                            @if(Str::contains($p, "EdemaRLE"))
                            RLE: {{Str::replace("EdemaRLE", "", $p)}}
                            @endif
                            @endforeach
                            @endif
                            @if(!empty($visit->first()->PulseLLE))
                            @foreach(explode(",", $visit->first()->PulseLLE) as $p)
                            @if(Str::contains($p, "EdemaLLE"))
                            LLE: {{Str::replace("EdemaLLE", "", $p)}}
                            @endif
                            @endforeach
                            @endif
                        </td>

                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 text-primary">
                            NEUROLOGICAL
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">EOM Intact</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->EOMIntact == "1" ? "Yes" : "No"}}
                        </td>

                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Facial Drooping</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->FacialDrooping == "1" ? "Yes" : "No"}}
                        </td>

                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 text-primary">
                            HEENT
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Nose</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->Nose}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Mouth</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->Mouth}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Mucous Membrane</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->MucousMembrane}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Ears</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->Ears}}
                        </td>
                    </tr>
                </table>
            </td>
            <td style="vertical-align: top;">
                <table style="width: 100%;">
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 text-primary" colspan="2">
                            EXTREMITIES
                        </td>

                    </tr>

                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Decreased Muscle Strength</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{
                                ($visit->first()->DecreasedStrengthRUE != "DecreasedStrengthRUENone" && Str::length($visit->first()->DecreasedStrengthRUE) > 0 ? " RUE " : "") . 
                                    ($visit->first()->DecreasedStrengthLUE != "DecreasedStrengthLUENone" && Str::length($visit->first()->DecreasedStrengthLUE) > 0 ? " LUE " : "") .
                                    ($visit->first()->DecreatedStrengthRLE != "DecreasedStrengthRLENone" && Str::length($visit->first()->DecreatedStrengthRLE) > 0 ? " RLE " : "") .
                                    ($visit->first()->DecreasedStrengthLLE != "DecreasedStrengthLLENone" && Str::length($visit->first()->DecreasedStrengthLLE) > 0 ? " LLE " : "")}}
                        </td>

                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Decreased ROM</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{($visit->first()->DecreasedROMRUE != "DecreasedROMRUENone" && Str::length($visit->first()->DecreasedROMRUE) > 0 ? " RUE " : "") .
                                    ($visit->first()->DecreasedROMLUE != "DecreasedROMLUENone" && Str::length($visit->first()->DecreasedROMLUE) > 0 ? " LUE " : "") . 
                                    ($visit->first()->DecreatedROMRLE != "DecreasedROMRLENone" && Str::length($visit->first()->DecreatedROMRLE) > 0 ? " RLE " : "") .
                                    ($visit->first()->DecreasedROMLLE != "DecreasedROMLLENone" && Str::length($visit->first()->DecreasedROMLUE) > 0 ? " LLE " : "")}}
                        </td>

                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Contractures</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{($visit->first()->ContracturesRUE != "DecreasedContracturesRUENone" && Str::length($visit->first()->ContracturesRUE) > 0 ? " RUE " : "") .
                                    ($visit->first()->ContracturesLUE != "DecreasedContracturesLUENone" && Str::length($visit->first()->ContracturesLUE) > 0 ? " LUE " : "") . 
                                    ($visit->first()->ContracturesRLE != "DecreasedContracturesRLENone" && Str::length($visit->first()->ContracturesRLE) > 0 ? " RLE " : "") .
                                    ($visit->first()->ContracturesLLE != "DecreasedContracturesLLENone" && Str::length($visit->first()->ContracturesLLE) > 0 ? " LLE " : "")}}
                        </td>

                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Sensation Intact</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{($visit->first()->RUESensationIntact != "SensationIntactRUENo" && Str::length($visit->first()->RUESensationIntact) > 0 ? " RUE " : "") .
                                    ($visit->first()->LUESensationIntact != "SensationIntactLUENo" && Str::length($visit->first()->LUESensationIntact) > 0 ? " LUE " : "") . 
                                    ($visit->first()->RLESensationIntact != "SensationIntactRLENo" && Str::length($visit->first()->RLESensationIntact) > 0 ? " RLE " : "") .
                                    ($visit->first()->LLESensationIntact != "SensationIntactLLENo" && Str::length($visit->first()->LLESensationIntact) > 0 ? " LLE " : "")}}
                        </td>

                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Normocephalic</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->Normocephalic == "1" ? "Yes" : "No"}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 text-primary" colspan="2">
                            LYMPHADENOPATHY
                        </td>

                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Axillary Nodes</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->Axillary}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Neck</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->Neck}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Groin</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->Groin}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 text-primary" colspan="2">
                            GASTROINTESTINAL
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Abdomen</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->Abdomen}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Obese</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->Obese}}
                        </td>

                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Hernia</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->Hernia == "1" ? "Yes" : "No"}}
                        </td>

                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Bowel Sounds</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->BowelSounds == "1" ? "Yes" : "No"}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 text-primary" colspan="2">
                            RESPIRATORY
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Trachea Midline</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->TracheaMidline == "1" ? "Yes" : "No"}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Lungs Sound</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->LungsSound}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <br>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="subheaders m-1 p-1">
                <h6 class="text-primary mb-0"><strong>Supplemental Documentation</strong></h6>
            </td>
        </tr>
        <tr>
            <td class="header" colspan="2"></td>
        </tr>
        <tr>
            <td class="w-100" colspan="2" style="vertical-align: top;">
                <table style="width: 100%;">
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Provider Discussed with</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->ProviderDiscussion}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Follow Up</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->FollowUpDate}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Time Spent with Patient</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->MinsSpent}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Preventive Measures</span>
                            </div>
                        </td>
                        <td class="lineheight"
                            style="word-break:break-all; width: 50%; -ms-word-break: break-all;word-break: break-word;">
                            {{$visit->first()->PreventiveMeasures}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Procedures</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->Procedures}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Patient Chart Reviewed</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$visit->first()->PatientChartReviewed == "1" ? "Yes" : "No"}}
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <br>
            </td>
        </tr>
        @if($visit->first()->labs->count() > 0)
        <tr>
            <td colspan="2" class="subheaders m-1 p-1">
                <h6 class="text-primary mb-0"><strong>Investigations</strong></h6>
            </td>
        </tr>
        <tr>
            <td class="header" colspan="2"></td>
        </tr>

        @foreach($visit->first()->labs as $lab)
        <tr>
            <td class="subheaders pl-1 pt-1 pb-1 pr-0" colspan="2">
                {{$lab->Type . ' has been ' . ($lab->Status == "Recommendation" ? "Recommended" : "Documented")}}
                {{($lab->Status != "Recommendation" ? " with a value of " . $lab->Result : "")}}
            </td>
        </tr>
        @endforeach
        @endif
        <tr>
            <td colspan="2">
                <br>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="subheaders m-1 p-1">
                <h6 class="text-primary mb-0"><strong>Wound Sites</strong></h6>
            </td>
        </tr>
        <tr>
            <td class="header" colspan="2">

            </td>
        </tr>
        @foreach($visit->first()->wounds as $wound)
        <tr>
            <td class="subheaders p-2 text-primary" colspan="2" style="background-color: #deebf8;">
                {{$wound->Location . ' ' . $wound->Left_Right . ' ' . $wound->Anterior_Dorsal . ' ' . $wound->Anterior_Posterior . ' ' . $wound->Inferior_Superior . ' ' . $wound->Medial_Lateral . ' ' . $wound->Proximal_Distal }}
                - <span class="text-danger">{{$wound->WoundStatus}}</span>
            </td>
        </tr>
        <tr>
            <td class="w-50" style="vertical-align: top;">
                <table style="width: 100%;">
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Etiology</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$wound->Etiology}}
                        </td>
                    </tr>
                    @if($wound->Etiology == "Pressure")
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Stage</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$wound->Stage}}
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Progress</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$wound->WoundProgress}}
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <table style="width: 100%;">
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Wound Size (L X W X D)</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$wound->Length . ' X ' . $wound->Width . ' X ' . $wound->Depth}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Exudate Amount</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            @if($wound->ExudateAmount == "1")
                            None
                            @elseif($wound->ExudateAmount == "2")
                            Small
                            @elseif($wound->ExudateAmount == "3")
                            Moderate
                            @elseif($wound->ExudateAmount == "4")
                            Large
                            @elseif($wound->ExudateAmount == "5")
                            Scant
                            @elseif($wound->ExudateAmount == "6")
                            Copious
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Exudate Type</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$wound->ExudateType}}
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Odor</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            @if($wound->Odor == "1")
                            None
                            @elseif($wound->Odor == "2")
                            Mild
                            @elseif($wound->Odor == "3")
                            Strong
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-100">
                            <div class="dots">
                                <span class="field">Pain level (0 -10)</span>
                            </div>
                        </td>
                        <td class="lineheight nowrap">
                            {{$wound->Pain == "11" ? 0 : ($wound->Pain == "12" ? "Insensate" : $wound->Pain)}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="lineheight p-1">
                <strong>Tissue Type</strong> -
                {{($wound->Scab ? "Scab" : (Str::length($wound->Granulation) > 0 ? $wound->Granulation . '% Gran' : '') 
                            . (Str::length($wound->Slough) > 0 ? ' | ' . $wound->Slough . '% Slough' : '') .
                             (Str::length($wound->Eschar) > 0 ? ' | ' . $wound->Eschar . '% Eschar' : '') . ' ' . 
                             (Str::length($wound->Epithialization) > 0 ? ' | ' . $wound->Epithialization . '% Epithelization' : ''))}}
            </td>
        </tr>
        @if(Str::length($wound->ExposedStructures) > 0)
        <tr>
            <td colspan="2" class="lineheight p-1">
                <strong>Exposed Structures</strong> -
                {{$wound->ExposedStructures}}
            </td>
        </tr>
        @endif
        <tr>
            <td class="subheaders pl-1 pt-1 pb-1 pr-0 text-primary" colspan="2">
                PERIWOUND
            </td>
        </tr>
        <tr>
            <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-50">
                <div class="dots">
                    <span class="field">Texture</span>
                </div>
            </td>
            <td class="lineheight nowrap">
                {{$wound->Periwound}}
            </td>
        </tr>
        <tr>
            <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-50">
                <div class="dots">
                    <span class="field">Color</span>
                </div>
            </td>
            <td class="lineheight nowrap">
                {{Str::replace("HemosiderinStaining", "Hemosiderin Staining",Str::replace("AtrophieBlanche", "Atrophie Blanche", $wound->Color))}}
            </td>
        </tr>
        <tr>
            <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-50">
                <div class="dots">
                    <span class="field">Moisture</span>
                </div>
            </td>
            <td class="lineheight nowrap">
                {{Str::replace("DryScaly", "Dry/Scaly", $wound->Moisture)}}
            </td>
        </tr>
        <tr>
            <td colspan="2" class="lineheight p-1">
                <strong>Treatment Plan</strong>
                - Apply {{$wound->TreatmentPlan}}
            </td>
        </tr>
        @if(!empty($wound->debridement))
        <tr>
            <td class="subheaders pl-1 pt-1 pb-1 pr-0 text-primary" colspan="2">
                PROCEDURES - DEBRIDEMENT
            </td>
        </tr>
        <tr>
            <td style="font-size: 12px;" colspan="2">
                Ulcer Location: {{$wound->Location}} POST-debridement length (cm) : {{$wound->debridement->Length}}
                width (cm) : {{$wound->debridement->Width}} depth (cm) : {{$wound->debridement->Depth}} Size of ulcer
                as noted on initial exam note. Percent debrided {{$wound->debridement->PercentDebridement}}
                Anesthesia:
                @if($wound->debridement->Anesthetic == "2%")
                2% Lido
                @elseif($wound->debridement->Anesthetic == "4%")
                4% Lido
                @elseif($wound->debridement->Anesthetic == "5%")
                5% Lido
                @elseif($wound->debridement->Anesthetic == "Insensate")
                Insensate
                @elseif($wound->debridement->Anesthetic == "Local%")
                Local % Inj.
                @elseif($wound->debridement->Anesthetic == "N/A")
                N/A
                @elseif($wound->debridement->Anesthetic == "Oral")
                Oral Analgesic
                @elseif($wound->debridement->Anesthetic == "Other")
                Other
                @endif
                Surgical debridement done to ulcer site, Minor surgery with ';
                identified risk factor. Discussed potential benefits and risks including but not limited to scar
                formation, bleeding, infection, and the patient desired treatment. Informed consent was obtained. Time
                out was taken before the surgical procedure,The area was prepped with alcohol, and adequate anesthesia
                was obtained.
                Devitalized epidermis, dermis and subcutaneous tissue
                {{($wound->Tissue == "Muscle" ? " muscle/fascia" : ($wound->Tissue == "Bone" ? ", muscle/fascia, and bone " : ""))}}
                removed including but not limited to biofilm to keep the wound in an active state of healing,
                fascia layer noted post procedure. The lesion was incised using a {{$wound->debridement->Instrument}}.
                The site was cleaned, bleeding was controlled via hemostasis, as per procedure documentation, dressing
                was applied by provider, and the wound was covered with ordered dressing. The patient and staff were
                given detailed ulcer care instructions and asked to monitor wound for any signs or symptoms of infection
                or other problems. The patient tolerated the procedure well without any complications. Time out taken.
                Dressing placed by provider. WOUND VOLUME S/P PROCEDURE IS-
                {{number_format($wound->debridement->Length * $wound->debridement->Width, 2, '.','')}} cm/
                {{number_format($wound->debridement->Length * $wound->debridement->Width * $wound->debridement->Depth, 2, '.','')}}
            </td>
        </tr>
        @endif
        @if(!empty($wound->biopsy))
        <tr>
            <td class="subheaders pl-1 pt-1 pb-1 pr-0 text-primary" colspan="2">
                PROCEDURES - BIOPSY
            </td>
        </tr>
        <tr>
            <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-50">
                <div class="dots">
                    <span class="field">Biopsy Type</span>
                </div>
            </td>
            <td class="lineheight nowrap">
                {{$wound->biopsy->BiopsyType}}
            </td>
        </tr>
        <tr>
            <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-50">
                <div class="dots">
                    <span class="field">
                        Size
                    </span>
                </div>
            </td>
            <td class="lineheight nowrap">
                {{$wound->biopsy->Size}} (mm)
            </td>
        </tr>
        <tr>
            <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-50">
                <div class="dots">
                    <span class="field">Pain Control</span>
                </div>
            </td>
            <td class="lineheight nowrap">
                @if($wound->biopsy->Pain == "2%")
                2% Lido
                @elseif($wound->biopsy->Pain == "4%")
                4% Lido
                @elseif($wound->biopsy->Pain == "5%")
                5% Lido
                @elseif($wound->biopsy->Pain == "Insensate")
                Insensate
                @elseif($wound->biopsy->Pain == "Local%")
                Local % Inj.
                @elseif($wound->biopsy->Pain == "N/A")
                N/A
                @elseif($wound->biopsy->Pain == "Oral")
                Oral Analgesic
                @elseif($wound->biopsy->Pain == "Other")
                Other
                @endif
            </td>
        </tr>
        <tr>
            <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-50">
                <div class="dots">
                    <span class="field">Instrument Used</span>
                </div>
            </td>
            <td class="lineheight nowrap">
                {{$wound->biopsy->Instrument}}
            </td>
        </tr>
        <tr>
            <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-50">
                <div class="dots">
                    <span class="field">Bleeding</span>
                </div>
            </td>
            <td class="lineheight nowrap">
                {{$wound->biopsy->BiopsyBleeding}}
            </td>
        </tr>
        <tr>
            <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-50">
                <div class="dots">
                    <span class="field">Post Pain</span>
                </div>
            </td>
            <td class="lineheight nowrap">
                {{$wound->biopsy->BiopsyPostPain}}
            </td>
        </tr>
        <tr>
            <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-50">
                <div class="dots">
                    <span class="field">Response to Treatment</span>
                </div>
            </td>
            <td class="lineheight nowrap">
                @if($wound->biopsy->BiopsyResponse == "1")
                Procedure was tolerated well
                else@if($wound->biopsy->BiopsyResponse == "2")
                Procedure was not tolerated well
                @endif
            </td>
        </tr>
        <tr>
            <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-50">
                <div class="dots">
                    <span class="field">Notes</span>
                </div>
            </td>
            <td class="lineheight nowrap">
                {{$wound->biopsy->BiopsyNotes}}
            </td>
        </tr>
        @endif
        @if(!empty($wound->cauterization))
        <tr>
            <td class="subheaders pl-1 pt-1 pb-1 pr-0 text-warning" colspan="2">
                PROCEDURES - CAUTERIZATION
            </td>
        </tr>
        <tr>
            <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-50">
                <div class="dots">
                    <span class="field">Pain</span>
                </div>
            </td>
            <td class="lineheight nowrap">
                @if($wound->cauterization->CCPain == "2%")
                2% Lido
                @elseif($wound->cauterization->CCPain == "4%")
                4% Lido
                @elseif($wound->cauterization->CCPain == "5%")
                5% Lido
                @elseif($wound->cauterization->CCPain == "Insensate")
                Insensate
                @elseif($wound->cauterization->CCPain == "Local%")
                Local % Inj.
                @elseif($wound->cauterization->CCPain == "N/A")
                N/A
                @elseif($wound->cauterization->CCPain == "Oral")
                Oral Analgesic
                @elseif($wound->cauterization->CCPain == "Other")
                Other
                @endif
            </td>
        </tr>
        <tr>
            <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-50">
                <div class="dots">
                    <span class="field">Post Pain</span>
                </div>
            </td>
            <td class="lineheight nowrap">
                {{$wound->cauterization->CCPostPain}} (mm)
            </td>
        </tr>
        <tr>
            <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-50">
                <div class="dots">
                    <span class="field">Bleeding</span>
                </div>
            </td>
            <td class="lineheight nowrap">
                {{$wound->cauterization->CCBleeding}}
            </td>
        </tr>
        <tr>
            <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-50">
                <div class="dots">
                    <span class="field">Extremity Location</span>
                </div>
            </td>
            <td class="lineheight nowrap">
                {{$wound->cauterization->CCExtremity}}
            </td>
        </tr>
        <tr>
            <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-50">
                <div class="dots">
                    <span class="field">Response to Treatment</span>
                </div>
            </td>
            <td class="lineheight nowrap">
                @if($wound->cauterization->CCResponse == "1")
                Procedure was tolerated well
                @elseif($wound->cauterization->CCResponse == "2")
                Procedure was not tolerated well
                @endif
            </td>
        </tr>
        <tr>
            <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-50">
                <div class="dots">
                    <span class="field">Notes</span>
                </div>
            </td>
            <td class="lineheight nowrap">
                {{$wound->cauterization->CCNotes}}
            </td>
        </tr>
        @endif
        @if(!empty($wound->cellulartissue))
        <tr>
            <td class="subheaders pl-1 pt-1 pb-1 pr-0 text-warning" colspan="2">
                CELLULAR TISSUE
            </td>
        </tr>
        <tr>
            <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-50">
                <div class="dots">
                    <span class="field">Wound Type</span>
                </div>
            </td>
            <td class="lineheight nowrap">
                {{$wound->cellulartissue->WoundType}}
            </td>
        </tr>
        <tr>
            <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-50">
                <div class="dots">
                    <span class="field">Product</span>
                </div>
            </td>
            <td class="lineheight nowrap">
                {{$wound->cellulartissue->Product}}
            </td>
        </tr>
        <tr>
            <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-50">
                <div class="dots">
                    <span class="field">Size</span>
                </div>
            </td>
            <td class="lineheight nowrap">
                {{$wound->cellulartissue->Size}}
            </td>
        </tr>
        <tr>
            <td class="subheaders pl-1 pt-1 pb-1 pr-0 w-50">
                <div class="dots">
                    <span class="field">Lot</span>
                </div>
            </td>
            <td class="lineheight nowrap">
                {{$wound->cellulartissue->Lot}}
            </td>
        </tr>
        @endif
        @if($wound->wounddiagnosis()->count() > 0)
        <tr>
            <td class="subheaders pl-1 pt-1 pb-1 pr-0 text-primary" colspan="2">
                WOUND DIAGNOSIS
            </td>
        </tr>
        <tr>
            <td style="font-size: 12px;">
                {{$wound->wounddiagnosis()->first()->ICD10 . ' - ' . $wound->wounddiagnosis()->first()->Description}}
            </td>
        </tr>
        @endif
        @endforeach
        @if($visit->first()->additionaldiagnosislist->count() > 0)
        <tr>
            <td colspan="2">
                <br>
            </td>
        </tr>

        <tr>
            <td colspan="2" class="subheaders m-1 p-1">
                <h6 class="text-primary mb-0"><strong>Additional Diagnosis</strong></h6>
            </td>
        </tr>
        <tr>
            <td class="header" colspan="2">

            </td>
        </tr>

        @foreach($visit->first()->additionaldiagnosislist as $ad)
        @if(!empty($ad->additionaldiagnosis))
        <tr>
            <td class='subtext'>
                {{$ad->additionaldiagnosis->ICD10}}
            </td>
            <td class='subtext'>
                {{$ad->additionaldiagnosis->Description}}
            </td>
        </tr>
        @endif
        @endforeach
        @endif
        <tr>
            <td colspan="2">
                <br>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="subheaders m-1 p-1">
                <h6 class="text-primary mb-0"><strong>Notes</strong></h6>
            </td>
        </tr>
        <tr>
            <td class="header" colspan="2">

            </td>
        </tr>
        <tr>
            <td style="font-size: 12px;" colspan="2">
                {{$visit->first()->PlanNotes}}
            </td>
        </tr>
        <tr>
            <td></td>
            <td class="subheaders text-right pb-2" colspan="2">
                Electronically Signed by -
                {{$visit->first()->addedby->firstname . ' ' . $visit->first()->addedby->lastname}}
            </td>
        </tr>
    </table>
</body>

</html>