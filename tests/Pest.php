<?php

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(Tests\TestCase::class)->in('Feature');
uses(LazilyRefreshDatabase::class)->in('Feature');
