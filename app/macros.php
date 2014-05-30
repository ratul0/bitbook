<?php

Form::macro('error', function($errors, $name)
{
    return '<p class="text-danger">'.$errors->first($name).'</p>';
});