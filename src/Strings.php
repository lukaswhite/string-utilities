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
}