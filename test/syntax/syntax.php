<?php
/**
 * User: daisy
 * Date: 13-12-28
 * Time: 下午12:24
 */

namespace test\syntax;


class Syntax extends \PHPUnit_Framework_TestCase {

    public function testExplode() {
        $c = explode(":", "xxoo kk");
        $this->assertEquals(1, count($c));
        $this->assertEquals("xxoo kk", $c[0]);
    }



    public function testPregMatch() {
        $data = '

<p>
  <strong>Location:</strong> London, UK
    <br /><strong>URL:</strong> <a href="http://www.countersoft.com">http://www.countersoft.com</a>
</p>

<div>At Countersoft we build software products that are used by Fortune 500, governments and everyone in between.</div><div class="paragraph_break"><br /></div><div>We’re nimble by nature and are looking for ambitious, motivated Sales Specialists to join us ASAP. We’re a fun, friendly and fast-growing technology company that strives for innovation at every opportunity.</div><div class="paragraph_break"><br /></div><div><strong>DUTIES</strong></div><div class="paragraph_break"><br /></div><ul><li>Identifying key decision-makers at target companies and making the initial contact &amp; pitch</li><li>
















Finding new prospect sources matching target customer segments and handling
the flow of inbound web-generated leads

</li><li>Hit sales targets and manage monthly, quarterly and yearly progression</li><li>Working with Founders and Product teams to help develop, tune products
and services</li><li>Developing and growing scalable partnerships and distribution channels</li><li>Attending trade events, customer sites as required</li><li>Managing key accounts and building long-term customer relationships</li></ul><div class="paragraph_break"><br /></div><div><strong>REQUIRED SKILLS</strong></div><div class="paragraph_break"><br /></div><ul><li>
















Highly competitive, self-starter with good team skills

</li><li>Keen eye for detail and passion to burn</li><li>Solid time management and organization skills</li><li>Brilliant written and verbal communication skills</li><li>Experience of both inbound and field sales</li></ul><div><strong><br /></strong></div><div><strong>DESIRED SKILLS</strong></div><div class="paragraph_break"><br /></div><ul><li>Experience with B2B sales</li><li>Experience selling enterprise software</li><li>Experience selling SaaS products</li></ul><div><strong><br /></strong></div><div><strong>PACKAGE</strong></div><div class="paragraph_break"><br /></div><ul><li>Work from anywhere, come into the office every now and then</li><li>£ COMPETITIVE SALARY + bonus/commission structure</li><li>Generous holiday allowance</li><li>Opportunity for travel if desired</li><li>Monday-Friday working week – no late working, no weekend working</li><li>…and the necessary tech gadgets to make your life easier</li></ul><div class="paragraph_break"><br /></div>


<p><strong>To apply:</strong> <a href="&#109;&#97;&#105;&#108;&#116;&#111;&#58;%63%61%72%65%65%72%73@%63%6f%75%6e%74%65%72%73%6f%66%74.%63%6f%6d">careers@countersoft.com</a></p>
';
        if (preg_match("/<div>(.+?)<\\/div>/", $data, $matches)) {
            echo $matches[1] . "\n";
        }
    }

    public function testHtml2Text()
    {
        $content = "The Voalte Engineering team is looking for an experienced and motivated iOS Application developer with a desire to create world-class mobile applications for the healthcare market.&nbsp; Voalte is redefining communication to improve patient care and increase caregiver productivity using the latest mobile devices such as the iPhone, iPod Touch and iPad.";
        echo $content . "\n";
        $c = $this->getplaintextintrofromhtml($content);
        echo $c . "\n";
    }

    private function getplaintextintrofromhtml($html) {

        // Remove the HTML tags
        //$html = strip_tags($html);

        // Convert HTML entities to single characters
        $html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');

        return $html;
    }


}
 