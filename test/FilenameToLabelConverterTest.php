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

namespace SphinxDocToAntoraMigrator\Tests;

use SphinxDocToAntoraMigrator\FilenameToLabelConverter;
use PHPUnit\Framework\TestCase;

/**
 * Class FilenameToLabelConverterTest
 * @package SphinxDocToAntoraMigrator\Tests
 */
class FilenameToLabelConverterTest extends TestCase
{
    public function converterDataProvider()
    {
        return [
            ['javascript_and_css', 'JavaScript and CSS'],
            ['activity_configuration', 'Activity Configuration'],
            ['ldap_proxy_cache_server_setup', 'LDAP Proxy Cache Server Setup'],
            ['index_php_less_urls', 'Index PHP Less URLs'],
            ['background_jobs_configuration', 'Background Jobs Configuration'],
            ['import_ssl_cert', 'Import SSL Cert'],
            ['user_provisioning_api', 'User Provisioning API'],
            ['antivirus_configuration', 'AntiVirus Configuration'],
            ['Ocs-recipient-api', 'OCS Recipient API'],
            ['two-factor-provider', 'Two Factor Provider'],
            ['l10n', 'L10N'],
            ['nginx_configuration', 'NGINX Configuration'],
            ['selinux_configuration', 'SELinux Configuration'],
            ['user_auth_ftp_smb_imap', 'User Auth FTP SMB IMAP'],
            ['openstack', 'OpenStack'],
            ['onedrive', 'OneDrive'],
            ['clamav', 'ClamAV'],
        ];
    }

    /**
     * @dataProvider converterDataProvider
     * @param string $from
     * @param string $to
     */
    public function testCanCorrectlyConvertFilenamesToLabels(string $from, string $to)
    {
        $converter = new FilenameToLabelConverter();
        $this->assertSame($to, $converter->convert($from));
    }
}
