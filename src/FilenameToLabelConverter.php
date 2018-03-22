<?php

namespace SphinxDocToAntoraMigrator;

/**
 * Class FilenameToLabelConverter
 * @package FilenameToLabelConverter
 */
class FilenameToLabelConverter
{
    const SMALL_WORDS = [
        'of','a','the','and','an','or','nor','but','is','if',
        'then','else','when', 'at','from','by','on','off',
        'for','in','out','over','to','into','with'
    ];

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
     * @param string $filename
     * @return string
     */
    public function convert(string $filename) : string
    {
        return $this->fixTitlecase(
            $this->convertCustomWords(
                $this->convertUppercaseWords(
                    str_replace(self::CORE_REPLACEMENTS, ' ', $filename)
                )
            )
        );
    }

    private function fixTitlecase(string $text) : string
    {
        return preg_replace_callback(
            sprintf('/\b(%s)\b/i', implode('|', self::SMALL_WORDS)),
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
    private function convertUppercaseWords(string $filename) : string
    {
        return preg_replace_callback(
            sprintf("/(%s)/i", implode('|', self::ALWAYS_UPPERCASE)),
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
    private function convertCustomWords(string $filename) : string
    {
        return preg_replace_callback(
            sprintf("/(%s)/i", implode('|', array_keys(self::CUSTOM_WORDS))),
            function ($match) {
                return self::CUSTOM_WORDS[strtolower($match[0])];
            },
            $filename
        );
    }
}
