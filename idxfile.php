<?php

function build(Idephix\Context $context)
{
    $context->local('mysql -hmysql -udev -pdev building < /var/www/tests/fixtures/db.sql');
    $context->local('bin/console c:c');
}
