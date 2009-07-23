<?php
class Generate_sitemap extends Controller
{
	function Generate_sitemap()
	{
		parent::Controller();
		$this->load->helper(array('text','url'));
		$this->load->plugin('google_sitemap'); //Load Plugin
	}

	function index()
	{
		$sitemap = new google_sitemap; //Create a new Sitemap Object

		// рецепты
		$query = $this->db->get('recipes');
		foreach ($query->result() as $row)
		{
			$item = new google_sitemap_item(base_url()."view_recipe/id/".$row->id,date("Y-m-d"), 'weekly', '0.8' );
			$sitemap->add_item($item);
		}
		//блог-посты
		$query = $this->db->get('blog');
		foreach ($query->result() as $row)
		{
			$item = new google_sitemap_item(base_url()."blog_post/".$row->id,date("Y-m-d"), 'weekly', '0.8' );
			$sitemap->add_item($item);
		}
		//блоги юзеров
		$query = $this->db->get('users');
		foreach ($query->result() as $row)
		{
			$item = new google_sitemap_item(base_url()."blog/user/".$row->ID,date("Y-m-d"), 'weekly', '0.8' );
			$sitemap->add_item($item);
		}
			
			$item = new google_sitemap_item(base_url()."blogs/",date("Y-m-d"), 'weekly', '0.8' );
			$sitemap->add_item($item);
			$item = new google_sitemap_item(base_url(),date("Y-m-d"), 'weekly', '0.8' );
			$sitemap->add_item($item);

		//$sitemap->add_item($item); //Append the item to the sitemap object
		$sitemap->build("./sitemap.xml"); //Build it...
		
		echo '—генерировано';

		//Let's compress it to gz
		$data = implode("", file("./sitemap.xml"));
		$gzdata = gzencode($data, 9);
		$fp = fopen("./sitemap.xml.gz", "w");
		fwrite($fp, $gzdata);
		fclose($fp);

		//Let's Ping google
		$this->_pingGoogleSitemaps(base_url()."/sitemap.xml.gz");
	}

	function _pingGoogleSitemaps( $url_xml )
	{
		$status = 0;
		$google = 'www.google.com';
		if( $fp=@fsockopen($google, 80) )
		{
			$req =  'GET /webmasters/sitemaps/ping?sitemap=' .
			urlencode( $url_xml ) . " HTTP/1.1\r\n" .
			"Host: $google\r\n" .
			"User-Agent: Mozilla/5.0 (compatible; " .
			PHP_OS . ") PHP/" . PHP_VERSION . "\r\n" .
			"Connection: Close\r\n\r\n";
			fwrite( $fp, $req );
			while( !feof($fp) )
			{
				if( @preg_match('~^HTTP/\d\.\d (\d+)~i', fgets($fp, 128), $m) )
				{
					$status = intval( $m[1] );
					break;
				}
			}
			fclose( $fp );
		}
		return( $status );
	}

}