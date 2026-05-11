<?php

it('can access the home page', function () {
    $this->get('/')->assertOk();
});
