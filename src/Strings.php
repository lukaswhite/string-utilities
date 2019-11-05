<?php

namespace Lukaswhite\StringUtilities;

/**
 * Class Strings
 *
 * Just some miscellaneous string utilities.
 *
 * @package Lukaswhite\StringUtilities
 */
class Strings
{
    /**
     * Strip punctuation from a string
     *
     * @param string $str
     * @return string
     */
    public static function stripPunctuation( string $str ) : string
    {
        return preg_replace( '#[[:punct:]]#', '', $str );
    }

    /**
     * Strip multiple spaces; useful in conjunction with stripPunctuation()
     *
     * @param string $str
     * @return $str
     */
    public static function stripMultipleSpaces( string $str ) : string
    {
        return preg_replace('/\s+/', ' ', $str );
    }

    /**
     * Replace the nth occurrence of a substring in a string
     *
     * @param string $search
     * @param string $replace
     * @param string $subject
     * @param int $nth
     * @return string
     */
    public static function replaceNth( string $search, string $replace, string $subject, int $nth ) : string
    {
        $found = preg_match_all(
            '/'.preg_quote( $search ).'/',
            $subject,
            $matches,
            PREG_OFFSET_CAPTURE);
        if ( false !== $found && $found > $nth ) {
            return substr_replace(
                $subject,
                $replace,
                $matches[ 0 ][ $nth ][ 1 ],
                strlen( $search )
            );
        }
        return $subject;
    }

    /**
     * Replace all but the first occurences of a string
     *
     * @param string $search
     * @param string $replace
     * @param string $subject
     * @return string
     */
    public static function replaceAllButFirstOccurence( string $search, string $replace, string $subject ) : string
    {
        $occurences = substr_count( $subject, $search ) - 1;
        if ( $occurences > 1 ) {
            return sprintf(
                '%s%s',
                substr( $subject, 0, ( strpos( $subject, $search ) + strlen( $search ) ) ),
                preg_replace(
                    sprintf( '/%s/', $search ),
                    $replace,
                    substr( $subject, ( strpos( $subject, $search ) + strlen( $search ) ) )
                )
            );
        }
        return $subject;
    }

    /**
     * Generate a random hexadecimal number, as a string, of the specified length.
     *
     * @param int $length
     * @param bool $uppercase
     * @return string
     */
    public static function randomHex( string $length, ?bool $uppercase = false ) : string
    {
        $str = '';
        for ( $i = 0; $i < $length; $i++ ) {
            $str .= sprintf( '%x', mt_rand( 0, 15 ) );
        }
        return $uppercase ? strtoupper( $str ) : $str;
    }

    /**
     * Determine whether a string starts with the specified substring.
     *
     * @param string $haystack
     * @param string $needle
     * @param bool $caseInsensitive
     * @return bool
     */
    public static function startsWith( string $haystack, string $needle, ?bool $caseSsensitive = true ) : bool
    {
        if ( ! $caseSsensitive ) {
            $haystack = strtolower( $haystack );
            $needle = strtolower( $needle );
        }
        return ( substr( $haystack, 0, strlen( $needle ) ) === $needle );
    }

    /**
     * Determine whether a string ends with the specified substring.
     *
     * @param string $haystack
     * @param string $needle
     * @param bool $caseSsensitive
     * @return bool
     */
    public static function endsWith( string $haystack, string $needle, ?bool $caseSsensitive = true ) : bool
    {
        if ( ! $caseSsensitive ) {
            $haystack = strtolower( $haystack );
            $needle = strtolower( $needle );
        }

        return ( substr( $haystack, -strlen( $needle ) ) === $needle );
    }

    /**
     * Get an excerpt, by providing the required number of words.
     *
     * Credit: https://gist.github.com/wpscholar/8363040
     *
     * @param string $content The content to be transformed
     * @param int    $length  The number of words
     * @param string $more    The text to be displayed at the end, if shortened
     * @return string
     */
    public static function excerpt( string $content, int $length = 40, string $more = '...' )
    {
        $excerpt = strip_tags( trim( $content ) );
        $words = str_word_count( $excerpt, 2 );
        if ( count( $words ) > $length ) {
            $words = array_slice( $words, 0, $length, true );
            end( $words );
            $position = key( $words ) + strlen( current( $words ) );
            $excerpt = substr( $excerpt, 0, $position ) . $more;
        }
        return $excerpt;
    }

    /**
     * Get an excerpt, by providing the required number of characters.
     *
     * @param string $content The content to be transformed
     * @param int    $length  The number of characters
     * @param string $more    The text to be displayed at the end, if shortened
     * @return string
     */
    public static function excerptCharacters( string $content, int $length = 100, string $more = '...' )
    {
        if ( strlen( $content ) <= $length ) {
            return $content;
        }

        return preg_replace(
            '/\s+?(\S+)?$/',
            '',
            substr( $content, 0, $length )
        ) . $more;
    }

    /**
     * Get the characters that match a truth test.
     *
     * @param string $str
     * @param \Closure $check
     * @return array
     */
    public static function getCharacters( string $str, \Closure $check )
    {
        return array_filter( str_split( $str, 1 ), $check );
    }

    /**
     * Get the lowercase characters from a string
     *
     * @param string $str
     * @return array
     */
    public static function getLowercaseCharacters( string $str )
    {
        return self::getCharacters(
            $str,
            function( $char ) {
                return preg_match('/[a-z]+/', $char );
            }
        );
    }

    /**
     * Get the uppercase characters from a string
     *
     * @param string $str
     * @return array
     */
    public static function getUppercaseCharacters( string $str )
    {
        return self::getCharacters(
            $str,
            function( $char ) {
                return preg_match('/[A-Z]+/', $char );
            }
        );
    }

    /**
     * Get the digits from a string
     *
     * @param string $str
     * @return array
     */
    public static function getDigits( string $str )
    {
        return self::getCharacters(
            $str,
            function( $char ) {
                return preg_match('/\d/', $char );
            }
        );
    }

}