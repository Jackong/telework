<?php
/**
 * User: daisy
 * Date: 14-1-23
 * Time: 上午8:50
 */

namespace test\syntax;


class Preg extends \PHPUnit_Framework_TestCase {

    public function testImgPattern()
    {
        $data = "&lt;img alt=&quot;Resized_logo&quot; src=&quot;https://dge9rmgqjs8m1.cloudfront.net/wwr_s3/logos/0000/0385/logo.gif/resized_logo.png?r=3&quot; /&gt;

&lt;p&gt;
  &lt;strong&gt;Location:&lt;/strong&gt; Laguna Beach, Ca
    &lt;br /&gt;&lt;strong&gt;URL:&lt;/strong&gt; &lt;a href=&quot;http://strikepointmedia.com/&quot;&gt;http://strikepointmedia.com/&lt;/a&gt;
&lt;/p&gt;

&lt;div&gt;Strikepoint Media is a full-service advertising, marketing and design firm seeking a Motion Graphic Designer and Animator to work with our team to produce a series of short educational videos. This is a contract to hire position based out of our office in Laguna Beach with the potential to work remotely.&amp;nbsp;&lt;/div&gt;&lt;div class=&quot;paragraph_break&quot;&gt;&lt;br /&gt;&lt;/div&gt;&lt;div&gt;&lt;strong&gt;Key Responsibilities:&lt;/strong&gt;&lt;br /&gt;&lt;/div&gt;&lt;ul&gt;&lt;li&gt;Take existing scripts and design style frames, build story boards, animate and composite full videos.&lt;/li&gt;&lt;li&gt;Execute projects on quick timelines with attention to detail.&lt;/li&gt;&lt;li&gt;Maintain and demonstrate current knowledge of latest graphic design techniques, technology, trends, and best practices as appropriate to current projects.&lt;/li&gt;&lt;/ul&gt;&lt;div class=&quot;paragraph_break&quot;&gt;&lt;br /&gt;&lt;/div&gt;&lt;div&gt;&lt;strong&gt;Required Qualifications:&lt;/strong&gt;&lt;br /&gt;&lt;/div&gt;&lt;ul&gt;&lt;li&gt;3-4 years experience in Motion Graphics and Animation&lt;/li&gt;&lt;li&gt;Extensive experience using the Adobe Suite; After Effects, Illustrator and Photoshop required&lt;/li&gt;&lt;li&gt;Eye for design and visual storytelling&lt;/li&gt;&lt;li&gt;Ability to work well with others in a small team&lt;/li&gt;&lt;li&gt;Proficient in Mac only environment&lt;/li&gt;&lt;li&gt;Strong communication and organization skills&lt;/li&gt;&lt;/ul&gt;&lt;div class=&quot;paragraph_break&quot;&gt;&lt;br /&gt;&lt;/div&gt;


&lt;p&gt;&lt;strong&gt;To apply:&lt;/strong&gt; Please provide a resume, link to your online portfolio and your hourly rate to &lt;a href=&quot;&amp;#109;&amp;#97;&amp;#105;&amp;#108;&amp;#116;&amp;#111;&amp;#58;%69%6e%66%6f@%73%74%72%69%6b%65%70%6f%69%6e%74%6d%65%64%69%61.%63%6f%6d&quot;&gt;info@strikepointmedia.com&lt;/a&gt;. &lt;/p&gt;";
        $data = html_entity_decode($data, ENT_QUOTES, 'UTF-8');
        if (preg_match("/<img.+?src=\"(.+?)\"/", $data, $matches)) {
            echo $matches[1] . "\n";
        }
        if (preg_match("/<div>(.+?)<\\/div>/", $data, $matches)) {
            echo $matches[1] . "\n";
            $description = (preg_replace("/(<.+?>).+?(<\\/.+?>)/", "", $matches[1])) . "\n";
            echo $description . "\n";
            echo html_entity_decode($description, ENT_QUOTES, 'UTF-8') . "\n";
        }
    }
}
 