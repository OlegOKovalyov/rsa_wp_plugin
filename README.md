=== Rsa-Enc-Dec WordPress Plugin ===

Contributors: no<br>
Tags: encrypt, decrypt, rsa<br>
Requires at least: 3.0.1<br>
Tested up to: 4.9.10<br>
License: GPLv2 or later<br>
License URI: http://www.gnu.org/licenses/gpl-2.0.html<br>

RSA-encription and RSA-decription with public and private keys.


== Description ==

The WordPress plugin encrypts the back-end page content string wrapped with the shortcode tags such as: [rsa_tag]The string[/rsa_tag]. Before the string will be show on the front-end it is encrypted with RSA method private key and is placed in the '<dbprefix>rsa_table' table of database. Then the encrypted string takes out from database, decrypted with RSA method public key and placed on to the user screen. Encrypted string is saved in '<dbprefix>rsa_table' table of database. Rsa-Enc-Dec WordPress Plugin uses PHPSecLib v1.0.15 library.


== Installation ==

To install the plugin and get it working you need:

1. Upload `rsa-enc-dec` directory to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Place `[rsa_tag]The string[/rsa_tag]` in your page templates.

etc.<br><br>
== Frequently Asked Questions ==

= A question that someone might have =

An answer to that question.

= What about foo bar? =

Answer to foo bar dilemma.

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png`
(or jpg, jpeg, gif).
2. This is the second screen shot

== Changelog ==

= 1.0 =
* A change since the previous version.
* Another change.

= 0.5 =
* List versions from most recent at top to oldest at bottom.

== Upgrade Notice ==

= 1.0 =
Upgrade notices describe the reason a user should upgrade.  No more than 300 characters.

= 0.5 =
This version fixes a security related bug.  Upgrade immediately.

== Arbitrary section ==

You may provide arbitrary sections, in the same format as the ones above.  This may be of use for extremely complicated
plugins where more information needs to be conveyed that doesn't fit into the categories of "description" or
"installation."  Arbitrary sections will be shown below the built-in sections outlined above.

== A brief Markdown Example ==

Ordered list:

1. Some feature
1. Another feature
1. Something else about the plugin

Unordered list:

* something
* something else
* third thing

Here's a link to [WordPress](http://wordpress.org/ "Your favorite software") and one to [Markdown's Syntax Documentation][markdown syntax].
Titles are optional, naturally.

[markdown syntax]: http://daringfireball.net/projects/markdown/syntax
            "Markdown is what the parser uses to process much of the readme file"

Markdown uses email style notation for blockquotes and I've been told:
> Asterisks for *emphasis*. Double it up  for **strong**.

`<?php code(); // goes in backticks ?>`