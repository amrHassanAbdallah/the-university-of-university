<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>The university of university @yield('page-name')</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{asset('vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic"
          rel="stylesheet" type="text/css">
    <link href="{{asset('vendor/simple-line-icons/css/simple-line-icons.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('css/stylish-portfolio.min.css')}}" rel="stylesheet">

    <!-- code hint -->
    <link rel="stylesheet"
          href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css">

    <style>
        .dataTables_paginate a {
            margin: 0 5px;
        }

        .col-lg-6 {
            margin-bottom: 10px;
        }

        .teacherSect img {
            max-width: 200px;
            height: auto;
            border-radius: 100px;
            border: 1px solid black;
        }

        .nav-tabs li {
            margin-right: 10px;
            padding: 20px 40px;
            border: 1px solid black;
        }

    </style>
</head>