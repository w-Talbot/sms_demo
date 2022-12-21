<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\SMSLogic\PHCSMS;

class PHCSMSTest extends TestCase
{


    public function test_PHCSMS_0001_dateEqualsSMSTrigger_valid_dates()
    {
        $yesterday = new \DateTime('yesterday');
        $yesterday = $yesterday->format('Y-m-d');

        $testObject = new PHCSMS();
        $actual = $testObject->dateEqualsSMSTrigger($yesterday,1);

        $this->assertEquals(true, $actual);
    }

    /**
     * Tests the dateEqualsSMSTrigger with out of bound dates.
     *
     * @return void
     */
    public function test_PHCSMS_0002_dateEqualsSMSTrigger_out_of_bound_dates()
    {
        $testObject = new PHCSMS();
        $actual = $testObject->dateEqualsSMSTrigger('2022-01-01',2);

        $this->assertEquals(false, $actual);
    }

    /**
     * Tests the phoneFormatter with valid phone number.
     *
     * @return void
     */
    public function test_PHCSMS_0003_phoneFormatter_with_valid_numbers()
    {

        $testObject = new PHCSMS();
        $actual = $testObject->phoneFormatter('+44 01234-567890');
        $expected = '441234567890';
        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests the phoneFormatter with INVALID phone numbers.
     *
     * @return void
     */
    public function test_PHCSMS_0004_phoneFormatter_with_invalid_numbers()
    {
        $testObject = new PHCSMS();
        $actual = $testObject->phoneFormatter('0127890');
        $expected = '';
        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests the phoneFormatter with phone number that needs formatting.
     *
     * @return void
     */
    public function test_PHCSMS_0005_phoneFormatter_with_unformatted_numbers()
    {
        $testObject = new PHCSMS();
        $actual = $testObject->phoneFormatter('01234567890');
        $expected = '441234567890';
        $this->assertEquals($expected, $actual);
    }



}
