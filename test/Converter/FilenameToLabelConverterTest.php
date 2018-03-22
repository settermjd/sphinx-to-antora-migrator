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

namespace SphinxDocToAntoraMigrator\Tests\Converter;

use SphinxDocToAntoraMigrator\Converter\FilenameToLabelConverter;
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
            [
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[javascript_and_css]',
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[JavaScript and CSS]'],
            [
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[activity_configuration]',
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[Activity Configuration]'],
            [
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[ldap_proxy_cache_server_setup]',
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[LDAP Proxy Cache Server Setup]'],
            [
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[index_php_less_urls]',
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[Index PHP Less URLs]'],
            [
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[background_jobs_configuration]',
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[Background Jobs Configuration]'],
            [
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[import_ssl_cert]',
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[Import SSL Cert]'],
            [
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[user_provisioning_api]',
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[User Provisioning API]'],
            [
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[antivirus_configuration]',
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[AntiVirus Configuration]'],
            [
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[Ocs-recipient-api]',
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[OCS Recipient API]'],
            [
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[two-factor-provider]',
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[Two Factor Provider]'],
            [
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[l10n]',
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[L10N]'],
            [
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[nginx_configuration]',
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[NGINX Configuration]'],
            [
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[selinux_configuration]',
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[SELinux Configuration]'],
            [
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[user_auth_ftp_smb_imap]',
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[User Auth FTP SMB IMAP]'],
            [
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[openstack]',
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[OpenStack]'
            ],
            [
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[onedrive]',
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[OneDrive]'
            ],
            [
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[clamav]',
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[ClamAV]'
            ],
            [
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[Upgrade Php]',
                '************* xref:./../../../../clients/ownCloud/antora-build/admin_manual/modules/admin_manual/pages/upgrading/upgrade_php.adoc[Upgrade PHP]'
            ]
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
