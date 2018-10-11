<?php

use Lukaswhite\StringUtilities\Strings;

class StringsTest extends \PHPUnit\Framework\TestCase
{
    public function testStripPunctuation( )
    {
        $this->assertEquals(
            'This is a sentence with  some  punctuation',
            Strings::stripPunctuation( 'This, is a sentence, with - some - punctuation.' )

        );
    }

    public function testStripMultipleSpaces( )
    {
        $this->assertEquals(
            'This is a sentence with some punctuation',
            Strings::stripMultipleSpaces( 'This is a sentence with  some  punctuation' )

        );

        $this->assertEquals(
            ' hkjhfg fg fdgfsdgf fgfdgsd dsfgdfg fdsgdf fdg ',
            Strings::stripMultipleSpaces( ' hkjhfg fg fdgfsdgf fgfdgsd       dsfgdfg       fdsgdf fdg   ' )
        );
    }

    public function testReplaceNth( )
    {
        $this->assertEquals(
            '0000010000',
            Strings::replaceNth( '0', '1', '0000000000', 5 )
        );

        $this->assertEquals(
            '12345',
            Strings::replaceNth( '0', '1', '12345', 5 )
        );

        $this->assertEquals(
            'This is a sentence with some punctuation',
            Strings::stripMultipleSpaces(
                Strings::stripPunctuation( 'This, is a sentence, with - some - punctuation.' )
            )

        );
    }

    public function testReplaceAllButFirstOccurence( )
    {
        $this->assertEquals(
            '0111111111',
            Strings::replaceAllButFirstOccurence( '0', '1', '0000000000' )
        );

        $this->assertEquals(
            '0000000000',
            Strings::replaceAllButFirstOccurence( '1', '2', '0000000000' )
        );
    }

    public function testRandomHex( )
    {
        $this->assertEquals( 5, strlen( Strings::randomHex( 5 ) ) );
        $this->assertTrue( ctype_alnum( Strings::randomHex( 5 ) ) );
    }

    public function testStartsWith( )
    {
        $this->assertTrue( Strings::startsWith( 'This is a test', 'This' ) );
        $this->assertFalse( Strings::startsWith( 'This is a test', 'this' ) );
        $this->assertTrue( Strings::startsWith( 'This is a test', 'this', false ) );
        $this->assertFalse( Strings::startsWith( 'test', 'This is a test' ) );
    }

    public function testEndsWith( )
    {
        $this->assertTrue( Strings::endsWith( 'This is a Test', 'Test' ) );
        $this->assertFalse( Strings::endsWith( 'This is a Test', 'test' ) );
        $this->assertTrue( Strings::endsWith( 'This is a Test', 'test', false ) );
        $this->assertFalse( Strings::endsWith( 'This', 'This is a test' ) );
    }

    public function testExcerptWords( )
    {
        $short = 'This is a test';
        $this->assertEquals( $short, Strings::excerpt( $short ) );

        $long = 'This is a test, to see if the excerpt function works properly';
        $this->assertEquals(
            'This is a test, to see if the excerpt...',
            Strings::excerpt( $long, 9 )
        );
    }

    public function testExcerptCharacters( )
    {
        $short = 'This is a test';
        $this->assertEquals( $short, Strings::excerptCharacters( $short ) );

        $long = 'This is a test, to see if the excerpt function works properly';
        $this->assertEquals(
            'This is a test, to see if the excerpt...',
            Strings::excerptCharacters( $long, 42 )
        );

    }
}