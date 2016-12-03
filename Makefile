php:
	composer update
clear:
	find  -name "*.DS*" -type f -delete && find  -name "*._*" -type f -delete
suite-test: test1 test2 test3 test4
test4:
	php phpunit-old.phar test/PayloadHandlerTest.php
test2:
	php phpunit-old.phar test/CompareVisitorsDataTest.php
test3:
	php phpunit-old.phar test/ReconizerLinkTest.php
test1:
	php phpunit-old.phar test/ProductsTest.php
