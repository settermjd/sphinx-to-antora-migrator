<?php
/**
 * @author Matthew Setter <matthew@matthewsetter.com>
 *
 * @copyright Copyright (c) 2017, ownCloud GmbH
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 */

namespace SphinxDocToAntoraMigrator\Converter;

/**
 * Class FilenameToLabelConverter
 * @package SphinxDocToAntoraMigrator
 */
class FilenameToLabelConverter
{
    const SEARCH_REGEX = "/\b(%s)\b/i";
    const LABEL_REGEX = '/.*\[(.*)\]/';
    const FIX_REGEX = '/(.*)(\[.*\])/';

    /**
     * Words such as prepositions and conjunctions that can be all lowercaseed
     */
    const SMALL_WORDS = [
        'of', 'a', 'the', 'and', 'an', 'or', 'nor', 'but', 'is', 'if',
        'then', 'else', 'when', 'at', 'from', 'by', 'on', 'off',
        'for', 'in', 'out', 'over', 'to', 'into', 'with'
    ];

    /**
     * Core elements to be replaced
     */
    const CORE_REPLACEMENTS = ['_', '-'];

    /**
     * @var array A list of words that must always be upper-cased
     */
    const ALWAYS_UPPERCASE = [
        'api',
        'css',
        'db',
        'ftp',
        'gui',
        'imap',
        'js',
        'ldap',
        'nginx',
        'oc',
        'occ',
        'ocs',
        'php',
        'sftp',
        'smb',
        'ssl',
        'ui',
        'ucs',
        'url',
        'l10n',
    ];

    /**
     * A list of custom words that have to be rendered case-sensitive
     *
     * The key/value representation is just a simple way to make the
     * data structure easier to work with.
     */
    const CUSTOM_WORDS = [
        'amazons3' => 'AmazonS3',
        'antivirus' => 'AntiVirus',
        'clamav' => 'ClamAV',
        'javascript' => 'JavaScript',
        'onedrive' => 'OneDrive',
        'openstack' => 'OpenStack',
        'owncloud' => 'ownCloud',
        'selinux' => 'SELinux',
    ];

    /**
     * Convert the string so that it can be used as an Asciidoc link
     * @param string $filename
     * @return string
     */
    public function convert(string $filename): string
    {
        $status = preg_match(self::LABEL_REGEX, $filename, $matches);
        list(, $match) = $matches;

        if ($status) {
            $replacement = $this->titlecase(
                $this->convertCustomWords(
                    $this->convertUppercaseWords(
                        $this->doInitialCleanup($match)
                    )
                )
            );

            return preg_replace(self::FIX_REGEX, "$1[${replacement}]", $filename);
        }

        return $filename;
    }

    /**
     * Titlecases the supplied string
     *
     * @param string $text
     * @return string
     */
    private function titlecase(string $text): string
    {
        return preg_replace_callback(
            sprintf(self::SEARCH_REGEX, implode('|', self::SMALL_WORDS)),
            function ($match) {
                return strtolower($match[0]);
            },
            ucwords($text)
        );
    }

    /**
     * @param string $filename
     * @return string
     */
    private function convertUppercaseWords(string $filename): string
    {
        return preg_replace_callback(
            sprintf(self::SEARCH_REGEX, implode('|', self::ALWAYS_UPPERCASE)),
            function ($match) {
                return strtoupper($match[0]);
            },
            $filename
        );
    }

    /**
     * @param string $filename
     * @return string
     */
    private function convertCustomWords(string $filename): string
    {
        return preg_replace_callback(
            sprintf(self::SEARCH_REGEX, implode('|', array_keys(self::CUSTOM_WORDS))),
            function ($match) {
                return self::CUSTOM_WORDS[strtolower($match[0])];
            },
            $filename
        );
    }

    /**
     * Does an initial set of cleanup on the supplied string
     *
     * @param string $filename
     * @return string
     */
    private function doInitialCleanup(string $filename): string
    {
        return str_replace(['_', '-'], ' ', $filename);
    }

}
