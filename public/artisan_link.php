<?php
// TEMPORARY FILE — DELETE AFTER USE
$target = realpath(__DIR__ . '/../storage/app/public');
$link   = __DIR__ . '/storage';

echo '<pre>';
echo 'Target : ' . $target . "\n";
echo 'Link   : ' . $link . "\n\n";

if (!$target) {
    echo "❌ Target path not found: " . __DIR__ . '/../storage/app/public';
} elseif (file_exists($link) || is_link($link)) {
    echo "⚠️  Link already exists at: $link\n";
    echo is_link($link) ? "   (is a symlink → " . readlink($link) . ")" : "   (is a regular folder — may need to delete it first)";
} elseif (symlink($target, $link)) {
    echo "✅ Symlink created successfully!\n";
    echo "   $link → $target";
} else {
    echo "❌ symlink() failed — hosting may block it.\n";
    echo "   Create symlink manually in Plesk File Manager:\n";
    echo "   Link  : httpdocs/public/storage\n";
    echo "   Target: $target";
}
echo '</pre>';
echo '<p><strong>DELETE this file after use!</strong></p>';
