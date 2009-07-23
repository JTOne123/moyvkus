<?php 
echo '<?xml version="1.0" encoding="windows-1251"?>' . "\n";
?>
<rss version="2.0"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
    xmlns:admin="http://webns.net/mvcb/"
    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
    xmlns:content="http://purl.org/rss/1.0/modules/content/">

    <channel>
    
   <title><![CDATA[<?php echo $feed_name; ?>]]></title>

    <link><?php echo $feed_url; ?></link>
    <description><?php echo $page_description; ?></description>
    <dc:language><?php echo $page_language; ?></dc:language>
    <dc:creator><?php echo $creator_email; ?></dc:creator>

    <dc:rights>Copyright <?php echo gmdate("Y", time()); ?></dc:rights>
    <admin:generatorAgent rdf:resource="<?=base_url()?>" />

    <?php foreach($posts as $entry): ?>
    
        <item>

          <title><![CDATA[<?php echo xml_convert($entry->title); ?>]]></title>
          <link><![CDATA[<?php echo base_url().'blog_post/'.$entry->id ?>]]></link>

          <description><![CDATA[
      <?=word_limiter($entry->text, 50) ?>
       ]]></description>
           
        </item>

        
    <?php endforeach; ?>
    
    </channel></rss>