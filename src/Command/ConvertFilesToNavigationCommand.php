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

namespace SphinxDocToAntoraMigrator\Command;


use SphinxDocToAntoraMigrator\Converter\FilenameToLabelConverter;
use Symfony\Component\Console\{
    Command\Command,
    Input\InputInterface,
    Output\OutputInterface
};

class ConvertFilesToNavigationCommand extends Command
{
    protected function configure()
    {
        $this->setName('navigation:build-from-files')
            ->setDescription('Creates a navigation AsciiDoc file from the source files')
            ->setHelp('This command allows you to create an AsciiDoc navigation file which you can use with Antora from a series of source files.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Build a list of the available content
        $input = stream_get_contents(fopen("php://stdin", "r"));
        $files = explode("\n", $input);
        $treeFiles = [];

        foreach ($files as $file) {
            if (empty($file)) {
                continue;
            }
            $parts = explode('/', $file);
            $filename = array_pop($parts);
            $parts = array_reverse($parts);
            $tree = [$filename => $file];
            foreach ($parts as $part) {
                if ($part === '.') {
                    continue;
                }
                $tree = [$part => $tree];
            }
            $treeFiles = array_merge_recursive($treeFiles, $tree);
        }

        $format = function($tree, $format, $nesting = 0) {
            ksort($tree, SORT_STRING);
            $files = [];
            $return = '';
            foreach ($tree as $name => $value) {
                if (is_string($value)) {
                    $files[$name] = $value;
                    continue;
                }
                $return .= sprintf(
                    "%s %s\n",
                    str_repeat('*', $nesting + 1),
                    ucfirst($name)
                );
                $return .= $format($tree[$name], $format, $nesting + 1);
            }
            foreach ($files as $name => $file) {
                $return .= sprintf(
                    "%s xref:%s[%s]\n",
                    str_repeat('*', $nesting + 1),
                    str_replace('.//', '', $file),
                    ucwords(str_replace('_', ' ', pathinfo($file, PATHINFO_FILENAME)))
                );
            }
            return $return;
        };
        $list = $format($treeFiles, $format);

        $converter = new FilenameToLabelConverter();
        echo $converter->convert($list);
    }
}
