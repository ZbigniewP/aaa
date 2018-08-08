{#
    This template is used to render any error different from 403, 404 and 500.

    This is the simplest way to customize error pages in Symfony applications.
    In case you need it, you can also hook into the internal exception handling
    made by Symfony. This allows you to perform advanced tasks and even recover
    your application from some errors.
    See https://symfony.com/doc/current/cookbook/controller/error_pages.html
#}

{% extends 'base.html.twig' %}

{% block body_id 'error' %}

{% block main %}
    <h1 class="text-danger">{{ 'http_error.name'|trans({ '%status_code%': status_code }) }}</h1>

    <p class="lead">
        {{ 'http_error.description'|trans({ '%status_code%': status_code }) }}
    </p>
    <p>
        {{ 'http_error.suggestion'|trans({ '%url%': path('blog_index') })|raw }}
    </p>
{% endblock %}

{% block sidebar %}
    {{ parent() }}

    {{ show_source_code(_self) }}
{% endblock %}
