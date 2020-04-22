<?php

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    $settings->add(new admin_setting_configtext('profspomanage/org_id', get_string('org_id', 'block_profspomanage'), "", null, PARAM_INT));
    $settings->add(new admin_setting_configtext('profspomanage/org_token', get_string('org_token', 'block_profspomanage'), "", null));
    $settings->add(new admin_setting_configtext('profspomanage/user_email', get_string('user_email', 'block_profspomanage'), "", null));
    $settings->add(new admin_setting_configtext('profspomanage/user_pass', get_string('user_pass', 'block_profspomanage'), "", null));
}