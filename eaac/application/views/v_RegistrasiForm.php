<?php
$email          	=	$fullname    	=	$emailreferensi =	$alamatkantor	=		$alamat 			= "";
$infogedung    		=	$provinsi    	=	$primarymsisdn 	=	$kota 			=		$secondarymsisdn 	= "";
$kodepos    		=	$noktp 		   	=	$tanggallahir  	=	$nokk  		  	=		$tempatlahir    	= "";
$imagektp      		=	$namaibu    	=	$imagepeg      	=	$phone    		=       $packagetype		= "";
$packagetypez       =   $offiaddrVal    =   "";
if(array_key_exists('insertion',$this->session->all_userdata())){   $mySess = $this->session->userdata;
$email          		= $mySess['insertion']['email'];
$alamatkantor    		= $mySess['insertion']['alamatkantor'];
$infogedung    			= $mySess['insertion']['infogedung'];
$primarymsisdn 			= $mySess['insertion']['primarymsisdn'];
$secondarymsisdn		= $mySess['insertion']['secondarymsisdn'];
$packagetype            = $mySess['ketPaket']['prod_name'];
$noktp 		   			= $mySess['insertion']['noktp'];
$nokk  		  			= $mySess['insertion']['nokk'];
$imagektp      			= $mySess['insertion']['imagektp'];
$imagepeg      			= $mySess['insertion']['imagepeg'];
$fullname    			= $mySess['insertion']['fullname'];
$alamat    				= $mySess['insertion']['alamat'];
$provinsi    			= $mySess['insertion']['provinsi'];
$kota    				= $mySess['insertion']['kota'];
$kodepos    			= $mySess['insertion']['kodepos'];
$tanggallahir    		= $mySess['insertion']['tanggallahir'];
$tempatlahir    		= $mySess['insertion']['tempatlahir'];
$namaibu    			= $mySess['insertion']['namaibu'];
$phone    				= $mySess['insertion']['phone'];
$emailreferensi			= $mySess['insertion']['emailreferensi'];
$alamatkantor=substr($alamatkantor, 0, strpos($alamatkantor, '.  '));
$packagetypez = $mySess['ketPaket']['prod_id'];
$exxx = explode('-',$tanggallahir);
$kotaku = $mySess['kota']; $offiaddrVal=implode('|', $mySess['ketKantor']);
}
?>

        <!-- MODAL MOBILE NAV -->
        <div class="modal fade modal-full" id="popmNav" tabindex="-1" role="dialog" aria-labelledby="popmNavLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="row">
                            <div class="col-xs-10">                  
                                <a href="https://www.telkomsel.com/" title="Personal" id="" class="">Personal</a>
                                <a href="https://www.telkomsel.com/bisnis" title="Bisnis" id="" class="active">Bisnis</a>
                                <a href="https://www.telkomsel.com/about-us" title="Tentang Kami" id="" class="">Tentang Kami</a>
                            </div>

                            <div class="col-xs-2 text-right">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="tkmsl-close"></span></button>
                            </div>
                        </div>
                    </div>

                    <div class="modal-body modal-main-menu">
                        <ul class="nav nav-tabs clearfix " role="tablist">
                            <li role="presentation"></li>
                            <li data-cache="26156edd-6b43-4546-8ee5-4a0ea354b5fc" role="presentation" class="nav-m-main-menu active">
                                <a href="https://www.telkomsel.com/bisnis#mSolutions" aria-controls="mSolutions" role="tab" data-toggle="tab">
                                    Enterprise
                                </a>
                            </li>
                            <li data-cache="d1fa6e1e-f446-4b48-9975-8a493494d72d" role="presentation" class="nav-m-main-menu">
                                <a href="https://www.telkomsel.com/bisnis#mnavProducts" aria-controls="mnavProducts" role="tab" data-toggle="tab">
                                    SME
                                </a>
                            </li>
                            <li data-cache="bb55432e-0ad2-4947-b829-dd3ac1a244fa" role="presentation" class="nav-m-main-menu">
                                <a href="https://www.telkomsel.com/support">
                                    Bantuan
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div data-cache="26156edd-6b43-4546-8ee5-4a0ea354b5fc" role="tabpanel" class="tab-pane fade in tab-m-main-menu active" id="mSolutions">
                                <div class="row row-0">
                                    <div class="col-xs-6">
                                        <a href="https://www.telkomsel.com/business/solution-enterprise" title="Enterprise products" class="nav-thumb-s " style="background-image: url(&#39;/sites/default/files/menu/nav_thumb_enterprise_products_267x200_0_1.jpg&#39;);">
                                            <h3>Enterprise products</h3>
                                            <p></p>
                                        </a>
                                    </div>

                                    <div class="col-xs-6">
                                        <a href="https://www.telkomsel.com/business/solution-enterprise/industry-solutions" title="Industry solutions" class="nav-thumb-s " style="background-image: url(&#39;/sites/default/files/menu/Industry%20solutions%20menu%402x.jpg&#39;);">
                                            <h3>Industry solutions</h3>
                                            <p></p>
                                        </a>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="panel-group" id="accordion343" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-default hsg-m">
                                            <div class="panel-heading" role="tab" id="m17604">
                                                <h4 class="panel-title">
                                                    <a href="https://www.telkomsel.com/business/solution-enterprise/mobilitas-perusahaan">
                                                        <span class="icon "></span> Mobility
                                                    </a>
                                                </h4>
                                            </div>
                                        </div>

                                        <div class="panel-heading" role="tab" id="m17605">
                                            <h4 class="panel-title">
                                                <a href="https://www.telkomsel.com/business/solution-enterprise/enterprise-communication">
                                                    <span class="icon "></span> Communications
                                                </a>
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="panel panel-default hsg-m">
                                        <div class="panel-heading" role="tab" id="m17606">
                                            <h4 class="panel-title">
                                                <a href="https://www.telkomsel.com/business/solution-enterprise/layanan-aplikasi-cloud">
                                                    <span class="icon "></span> Cloud &amp; Apps
                                                </a>
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="panel panel-default hsg-m">
                                        <div class="panel-heading" role="tab" id="m29723">
                                            <h4 class="panel-title">
                                                <a href="https://www.telkomsel.com/business/solution-enterprise/internet-things-iot">
                                                    <span class="icon "></span> Internet of Things
                                                </a>
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="panel panel-default hsg-m">
                                        <div class="panel-heading" role="tab" id="m29724">
                                            <h4 class="panel-title">
                                                <a href="https://www.telkomsel.com/business/solution-enterprise/digital-advertising">
                                                    <span class="icon "></span> Digital Advertising
                                                </a>
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="panel panel-default hsg-m">
                                        <div class="panel-heading" role="tab" id="m29725">
                                            <h4 class="panel-title">
                                                <a href="https://www.telkomsel.com/business/solution-enterprise/business-mobile-banking">
                                                    <span class="icon "></span> Mobile Banking
                                                </a>
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="panel panel-default hsg-m">
                                        <div class="panel-heading" role="tab" id="m124170">
                                            <h4 class="panel-title">
                                                <a href="https://www.telkomsel.com/business/business-value-added-services">
                                                    <span class="icon "></span> Business VAS
                                                </a>
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="panel panel-default hsg-m">
                                        <div class="panel-heading" role="tab" id="m48242">
                                            <h4 class="panel-title">
                                                <a href="https://www.telkomsel.com/business/solution-enterprise" class="see-more">
                                                    <span class="icon "></span> Lainnya
                                                </a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div data-cache="d1fa6e1e-f446-4b48-9975-8a493494d72d" role="tabpanel" class="tab-pane fade in tab-m-main-menu" id="mnavProducts">
                            <div class="row row-0">
                                <div class="col-xs-6">
                                    <a href="https://www.telkomsel.com/business/sme" title="Produk SME" class="nav-thumb-s " style="background-image: url(&#39;/sites/default/files/menu/thumb%20SME%20products.jpg&#39;);">
                                        <h3>Produk SME</h3>
                                        <p></p>
                                    </a>
                                </div>

                                <div class="col-xs-6">
                                    <a href="http://tsel.me/cbssme" title="Konsultasi dengan pakar kami" class="nav-thumb-s " style="background-image: url(&#39;/sites/default/files/menu/thumb%20App%20Store.jpg&#39;);">
                                        <h3>Konsultasi dengan pakar kami</h3>
                                        <p></p>
                                    </a>
                                </div>

                            </div>

                            <div class="">
                                <div class="panel-group" id="accordion348" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default hsg-m">
                                        <div class="panel-heading" role="tab" id="m17600">
                                            <h4 class="panel-title">
                                                <a href="https://www.telkomsel.com/business/sme/sme-mulai-di-sini">
                                                    <span class="icon "></span> Get Started
                                                </a>
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="panel panel-default hsg-m">
                                        <div class="panel-heading" role="tab" id="m17601">
                                            <h4 class="panel-title">
                                                <a href="https://www.telkomsel.com/business/sme/kembangkan-bisnis-anda">
                                                    <span class="icon "></span> Grow your Business
                                                </a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <div class="row row-0">
                        <div class="col-xs-6"></div>
                            <div class="col-xs-6 text-right m-lang">
                                <a href="https://www.telkomsel.com/bisnis" class="language-link is-active" hreflang="id" data-drupal-link-system-path="node/440">Id</a>                                                                                                    <a href="https://www.telkomsel.com/en/business" class="language-link" hreflang="en" data-drupal-link-system-path="node/440">En</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- </div> -->
        <!-- END MODAL MOBILE NAV -->



        <!-- MODAL MOBILE SEARCH -->
        <div class="modal fade modal-full" id="popmSearch" tabindex="-1" role="dialog" aria-labelledby="popmSearchLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header modal-header-search">
                        <div class="row">
                            <div class="col-xs-10">
                                <h4>What are you looking for ?</h4>
                            </div>
                            <div class="col-xs-2 text-right">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="tkmsl-close"></span></button>
                            </div>
                        </div>
                    </div>

                    <div class="modal-body modal-search">
                        <div class="search-panel" id="mobile-search">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <h4 class="hidden-xs">Apa yang anda cari</h4>
                                        <div class="form-group">
                                            <span class="tkmsl-search"></span>
                                            <div class="custom-acquia-search">
                                                <form action="https://www.telkomsel.com/search" method="get" id="views-exposed-form-acquia-search-page" accept-charset="UTF-8">
                                                    <div class="js-form-item form-item js-form-type-search-api-autocomplete form-item-search js-form-item-search">
                                                        <label for="edit-search">Search</label>
                                                        <input data-drupal-selector="edit-search" data-search-api-autocomplete-search="acquia_search" class="form-autocomplete form-text ui-autocomplete-input" data-autocomplete-path="/search_api_autocomplete/acquia_search?display=page&amp;&amp;filter=search" type="text" id="edit-search" name="search" value="" size="30" maxlength="128" placeholder="search" autocomplete="off">
                                                    </div>

                                                    <div data-drupal-selector="edit-actions" class="form-actions js-form-wrapper form-wrapper" id="edit-actions"><input data-drupal-selector="edit-submit-acquia-search" type="submit" id="edit-submit-acquia-search" value="Search" class="button js-form-submit form-submit">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="search-suggest" style="visibility: hidden;">
                                            <div class="row row-10">
                                                <div class="col-sm-4 col-xs-12">
                                                    <h5>
                                                        <span class="tkmsl-link-drop3"></span>
                                                        quick link
                                                    </h5>

                                                    <div class="row row-5 search-quick-link">
                                                        <div class="col-sm-4 col-xs-4">
                                                            <a href="javascript:void(0)" title="">
                                                                <span class="tkmsl-icon tkmsl-add-credit-drop3"></span>
                                                                Add Credit
                                                            </a>
                                                        </div>

                                                        <div class="col-sm-4 col-xs-4">
                                                            <a href="javascript:void(0)" title="">
                                                                <span class="tkmsl-icon tkmsl-packets-cascade"></span>
                                                                Package
                                                            </a>
                                                        </div>

                                                        <div class="col-sm-4 col-xs-4">
                                                            <a href="javascript:void(0)" title="">
                                                                <span class="tkmsl-icon tkmsl-heart-drop3"></span>
                                                                Telkomsel POIN
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-8 col-xs-12">
                                                    <h5>
                                                        <span class="tkmsl-light-drop3"></span>
                                                        suggestions
                                                    </h5>
                                                    <ul class="clearfix search-list">
                                                        <li>
                                                            <a href="javascript:void(0)" title=""><strong>simPATI</strong> Starter Packs</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)" title=""><strong>simPATI</strong> to kartuHalo</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)" title=""><strong>simPATI</strong> Transfer Credit</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)" title=""><strong>simPATI</strong> Gifting</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)" title="">Walk with <strong>simPATI</strong></a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)" title="">Walk with <strong>simPATI</strong></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="javascript:void(0)" title="See All Search Results" class="cta cta-arrow">
                                See All Search Results <span class="tkmsl-next"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="loader-page" style="background-color: rgb(255, 255, 255); position: fixed; top: 0px; bottom: 0px; left: 0px; right: 0px; z-index: 9999; box-sizing: border-box; display: none;">
            <img src="<?php echo base_url() ?>asset/Bisnis_Telkomsel_files/loader.gif" alt="" style="width: 75px; height: 75px; background: #0f2236; padding: 12.5px; position: absolute; top: 50%; left: 50%; bottom: initial; right: initial; box-sizing: border-box; -webkit-border-radius: 100%; -moz-border-radius: 100%; -ms-border-radius: 100%; -o-border-radius: 100%; border-radius: 100%; -webkit-transform: translate(-50%, -50%); -moz-transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%); -o-transform: translate(-50%, -50%); transform: translate(-50%, -50%);">
        </div>
        
  <!-- TROUBLE BEGAN HERE -->
  <div id="site-container">	

  <section class="breadcrumb-page scarlet">
    <div class="container">
      <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
          <h1 itemprop="name">Bisnis</h1>
          <meta content="1" itemprop="position">
        </li>
      </ol>
    </div>
  </section>      
				
  <div class="no-space"></div>                 
			
	<div class="row-fluid">
		<div class="maxWidth">
			<div id="contentIndiv" style="padding: 5% 5% 0% 5%">
				<div class="container-fluid fullWidth">
					<div class="row-fluid">
						<div class="maxWidth">

							<!-- Content Left Starts -->
							<div class="span12" style="margin-bottom: 50px">
								<div style="width: 100%; border-radius: 3px; background-color: #eee; padding: 0 0 100px 0">

                  <!-- TITLE REGISTRASI -->
                  <div style="width:95%;border-top-left-radius:3px;border-top-right-radius:3px;padding:8px 0 10px 5%">
                    <span style="font-family:&#39;Titillium Web&#39;,sans-serif;font-size:20px;font-weight:500;color:#666">Registrasi <span style="color:#de0300"> kartuHalo </span></span>
                    <div id="halo2" style="padding: 0 0%; font-family: &#39;Titillium Web&#39;, sans-serif; font-size: 15px; font-weight: 400; color: #666; margin-bottom: 0%">
                    <!-- 01 -->
                      <div class="row-fluid" style="margin-bottom: 5px">
                        <div class="span6">
                          <div style="width: 90%; float: left" id="pageNumber">
                            halaman 1 dari 2<span style="color: #de0300"><b></b></span>
                          </div>
                          <div style="width: 10%; float: left"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- END TITLE REGISTRASI -->



                  <div style="padding: 5% 2.5%;border:red 1px;">

                    <form id="registerForm" name="registrationform" action="<?php echo base_url(). 'registrasi/submit'; ?>" method="post" enctype="multipart/form-data">

                      <!-- FIELDSET 1 STARTS -->
                      <fieldset id="halaman1">

                        <!-- HEADER PILIH NOMOR -->
                        <div class="row-fluid" id="halo" style="margin-bottom: 10px">
                          <div style="width: 15%; float: left">
                            <img src="<?php echo base_url() ?>asset/Customer_Service_Online_files/input_jenis.png" border="0">
                          </div>
                          <div id="scrollHere1" style="width: 85%; float: left">
                            <legend style="text-align: right">
                              <span style="font-family: &#39;Titillium Web&#39;, sans-serif; font-size: 18px; font-weight: 400; color: #666;">PILIH <span style="color:#de0300">NOMOR</span></span>
                            </legend>
                          </div>
                        </div>

                        <!-- CONTAINER ALAMAT GEDUNG, CARI NOMOR , TYPE PACKAGE -->
                        <div id="halo2" style="padding: 0 7.5%; font-family: &#39;Titillium Web&#39;, sans-serif; font-size: 15px; font-weight: 400; color: #666; margin-bottom: 5%">

                          <!-- <div class="row-fluid" style="margin-bottom: 5px">
                            <div class="span6">
                              <div style="width: 90%; float: left">
                                Alamat Kantor<span style="color: #de0300"><b>*</b></span>
                                <br> <span style="font-family: &#39;Titillium Web&#39;, sans-serif; font-size: 13px; line-height: 18px;"><i>(Kartu SIM akan dikirim ke alamat ini)</i></span>
                              </div>
                              <div style="width: 10%; float: left">:</div>
                            </div> -->

                            <!-- INPUT ALAMAT GEDUNG -->
                            <!-- <div class="row-fluid" style="margin-bottom: 5px;">
                              <div class="row-fluid" style="margin-bottom: 5px">
                                <div class="span6" style="background-color: #fff; padding: 2.5%; border-radius: 5px;" id="msisdnParent"> -->
                                <!--    
                                    <div class="row-fluid" id="msisdnWrap1">
                                        <span>
                                            <input id="msisdn1" name="alamatkantor" class="radioSelectItemCustom radio-inline radio inline control-label radioSelectItem " type="radio" value="628113346866">
                                            <label for="msisdn1">Telkomsel Smart Office, Jl. Gatot Subroto kav. 52, Jakarta Selatan, DKI Jakarta</label>
                                        </span><br>
                                        <span>
                                            <input id="msisdn2" name="alamatkantor" class="radioSelectItemCustom radio-inline radio inline control-label radioSelectItem " type="radio" value="628112032922">
                                            <label for="msisdn2">GraPARI Mall Ambassador, Jl. Prof. Dr. Satrio no. 16, Karet Kuningan, Kuningan, Jakarta Selatan, DKI Jakarta</label>
                                        </span><br>
                                        <span>
                                            <input id="msisdn3" name="alamatkantor" class="radioSelectItemCustom radio-inline radio inline control-label radioSelectItem " type="radio" value="628116640972">
                                            <label for="msisdn3">GraPARI Telkomsel, Jl. Sultan Iskandar Muda, Arteri Pondok Indah, Kebayoran Lama, RT.10/RW.6, Kby. Lama Utara, Kby. Lama, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12240</label>
                                        </span><br>
                                        <span>
                                            <input id="msisdn4" name="alamatkantor" class="radioSelectItemCustom radio-inline radio inline control-label radioSelectItem " type="radio" value="628115837035">
                                            <label for="msisdn4">GraPARI Telkomsel, Jl. Rw. Belong No.20, RT.1/RW.9, Kb. Jeruk, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11530</label>
                                        </span>
                                    </div>
                                -->
                                  <!-- <div class="row-fluid" id="paagee"> -->

                                  <!-- LAWAS IKI
                                  <?php foreach ($this->session->userdata['alamat_antor'] as $value) {
                                  $checked = $alamatkantor==$value ? 'checked="checked"' : '';  ?>
                                    <span>
                                      <input id="alamat_antor" name="alamatkantor" class="radioSelectItemCustom radio-inline radio inline control-label radioSelectItem" type="radio" value="<?php echo $value;?>" <?php echo $checked; ?>>
                                      <label for="alamat_antor1"><?php echo $value;?></label>
                                    </span>
                                  <?php } ?>    
                                  -->

                                  <!-- USE THIS WHEN OSB ALREDY FIX THE ADDRESS
                                  <?php foreach ($this->session->userdata['alamat_antorz'] as $value) {
                                  $checked = $alamatkantor==$value['account_name'].', '.$value['address'] ? 'checked="checked"' : '';  ?>
                                    <span>
                                      <input id="alamat_antor" name="alamatkantor" class="radioSelectItemCustom radio-inline radio inline control-label radioSelectItem" type="radio" value="<?php echo $value['account_id'].'|'.$value['account_name'].', '.$value['address'].'|'.$value['region'];?>" <?php echo $checked; ?>>
                                      <label for="alamat_antor1"><?php echo $value['account_name'].', '.$value['address'].', '.$value['region'];?></label>
                                    </span>
                                  <?php } ?>
                                  -->

                                  <!-- <?php foreach ($this->session->userdata['alamat_antorz'] as $value) {
                                  $checked = $alamatkantor==$value['account_name'].', '.$value['account_id'] ? 'checked="checked"' : '';  ?>
                                    <span>
                                      <input id="alamat_antor" name="alamatkantor" class="radioSelectItemCustom radio-inline radio inline control-label radioSelectItem" type="radio" value="<?php echo $value['account_id'].'|'.$value['account_name'].', '.$value['account_id'].'|'.$value['region'];?>" <?php echo $checked; ?>>
                                      <label for="alamat_antor1"><?php echo $value['account_name'].', '.$value['account_id'].', '.$value['region'];?></label>
                                    </span>
                                  <?php } ?> -->

                                  <!--yg Banyak <?php foreach ($this->session->userdata['alamat_antorz'] as $value) {
                                    foreach($value['office'] as $off){
                                  $checked = $alamatkantor==$value['account_name'].', '.$value['account_id'] ? 'checked="checked"' : '';  ?>
                                    <span>
                                      <input id="alamat_antor" name="alamatkantor" class="radioSelectItemCustom radio-inline radio inline control-label radioSelectItem" type="radio" value="<?php echo $value['account_id'].'|'.$value['account_name'].', '.$value['account_id'].'|'.$value['region'];?>" <?php echo $checked; ?>>
                                      <label for="alamat_antor1"><?php echo $off['office_name'].', '.$off['office_address'].', '.$off['office_province'];?></label>
                                    </span>
                                  <?php }} ?> -->
                                  

                                  <!-- </div> -->

                                  <!-- <br> -->
                                    
                                  <!--
                                  <div class="row-fluid">
                                    <div id="paging" ></div> 
                                    
                                      <div class="span6" id="msisdnWrap2" style="display: none;">
                                          <a href="javascript:void(0)" onclick="getSearchNumber(&#39;prev&#39;)">
                                              <div style="float: left; width: 15%; margin-top: 10px">
                                                  <i class="fa fa-angle-left fa-lg"></i>
                                              </div>
                                              <div style="float: left; width: 75%; margin-top: 6px">
                                                  Sebelumnya
                                              </div>
                                          </a>
                                      </div>
                                      <div class="span6" id="msisdnWrap3">
                                          <a href="javascript:void(0)" onclick="getSearchNumber(&#39;next&#39;)">
                                              <div style="float: right; width: 15%; margin-top: 10px">
                                                  <i class="fa fa-angle-right fa-lg"></i>
                                              </div>
                                              <div style="float: right; width: 75%; margin-top: 6px;">
                                                  <div style="float: right; width: 85%;">
                                                      Selanjutnya
                                                  </div>
                                              </div>
                                          </a>
                                      </div>
                                    
                                  </div>
                                  -->
                                 <!--  <br>
                                  <div class="row-fluid" style="margin-bottom: 5px">
                                    <input id="infoGedung" name="infogedung" class="inputCustome" placeholder="Informasi tambahan (gedung, lantai, dll.)" type="text" value="<?php echo $infogedung; ?>" maxlength="100">
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row-fluid" style="margin-bottom: 1px;">
                              <div class="span6" style="margin-bottom: 1px;"></div>
                              <div class="span6" style="margin-bottom: 1px;">
                                <div style="width: 90%; float: left"></div>
                              </div>
                            </div> -->

                          <!-- </div> -->
                          <!-- END INPUT ALAMAT GEDUNG -->


                          <!-- INPUT DATABLE LO -->
                          <div class="row-fluid" style="margin-bottom: 5px">
                            <div class="span6">
                              <div style="width: 90%; float: left">
                                Alamat Kantor
                                <span style="color: #de0300"><b>*</b></span><br> <span style="font-family: &#39;Titillium Web&#39;, sans-serif; font-size: 13px; line-height: 18px;"><i>(Kartu SIM akan dikirim ke alamat ini)</i></span>
                              </div>
                              <div style="width: 10%; float: left">:</div>
                            </div>
                            <div class="span6" style="background-color: #fff; padding: 1% 1% 1% 2.5%; border-radius: 3px;">
                              <span id="ketaddoffice" style="font-family: &#39;Titillium Web&#39;, sans-serif; font-size: 13px">Silakan pilih Alamat Kantor Anda</span>
                            </div>

                            <div>

                              <div id="demo" style="margin-top: 3.5em;">
                                <table cellpadding="0" style="width:100%" cellspacing="0" border="0" class="display" id="example">
                                  <thead>
                                    <tr>
                                      <th></th>
                                      <th>Alamat Kantor</th>
                                      <th>Provinsi</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach($this->session->userdata['alamat_antorz'] as $ix=>$parentData){ 
                                        foreach($parentData['office'] as $ind=>$data){
                                            $checked = $alamatkantor==$data['office_address'] ? 'checked="checked"' : '';?>

                                    <tr>
                                      
                                      <td>
                                        <input id="<?php echo 'kantorKe'.$ix.'-'.$ind ?>" name="alamatkantor" type="radio" value="<?php echo $parentData['account_id'].'|'.$data['office_address'].'|'.$data['office_region'].'|'.$data['office_id'];?>" <?php echo $checked; ?>>
                                      </td>
                                      <td><?php echo $data['office_address'] ?></td>
                                      <td><?php echo $data['office_province'] ?></td>
                                      
                                    </tr>
                                    <?php } } ?>
                                  </tbody>
                                </table>
                              </div>

                            </div>

                          </div>

                          <div class="row-fluid" style="margin-bottom: 1px;">
                            <div class="span6" style="margin-bottom: 1px;"></div>
                            <div class="span6" style="margin-bottom: 1px;">
                              <div style="width: 90%; float: left"></div>
                            </div>
                          </div>
                          <!-- END DATABLE LO -->

                          <!-- INPUT Info Gedung -->
                          <div class="row-fluid" style="margin-bottom: 5px">
                            <div class="span6">
                              <div style="width: 90%; float: left">
                                Info Gedung
                              </div>
                              <div style="width: 10%; float: left">:</div>
                            </div>
                            <div class="span6">
                              <input id="infoGedung" name="infogedung" class="inputCustome" placeholder="Informasi tambahan (gedung, lantai, dll.)" type="text" value="<?php echo $infogedung; ?>" maxlength="100">
                            </div>
                          </div>

                          <div class="row-fluid" style="margin-bottom: 1px;">
                            <div class="span6" style="margin-bottom: 1px;"></div>
                            <div class="span6" style="margin-bottom: 1px;">
                              <div style="width: 90%; float: left"> </div>
                            </div>
                          </div>
                          <!-- END INPUT Info Gedung -->


                        <div id="showMeLater"><!-- onClick when alamatKantor checked -->
                          <!-- INPUT CARI NOMOR -->
                          <div class="row-fluid" style="margin-bottom: 5px">
                            <div class="span6">
                              <div style="width: 90%; float: left">
                                  Nomor Kartu<span style="color:#de0300"><b>*</b></span>
                                  <br> <span style="font-family: &#39;Titillium Web&#39;, sans-serif; font-size: 13px; line-height: 18px;"><i>(Nomor kartuHalo disesuaikan sesuai region)</i></span>
                              </div>
                              <div style="width: 10%; float: left">:</div>
                            </div>
                            <div class="span6">
                                <input type="hidden" value=<?php echo $primarymsisdn; ?> name="primaryMSISDN" >
                                <input id="primaryMSISDN" name="primaryMSISDN" type="text" placeholder="170845" class="inputCustome" style="font-size: 25px;width:75%;float:left;" maxlength="6" pattern="[0-9]*" value="<?php echo $primarymsisdn; ?>" />
                                <button id="carimsisdn" type="button" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Mencari..." class="btn btn-primary" style="font-family: &#39;Titillium Web&#39;, sans-serif;margin-top:3px; float: left;width:25%;">Cari</button>
                                
                                <!--
                                <button onclick="#" type="button" class="btn btn-info" style="font-family: &#39;Titillium Web&#39;, sans-serif; float: left;">Sarankan Nomor Cantik</button>
                                
                                <input type="button" value="Cari" onclick="getSearchNumber(&#39;search&#39;)" />
                                <input type="button" value="Sarankan Nomor Cantik" onclick="getSearchNumber(&#39;search&#39;)" />
                              -->
                            </div>
                          </div>

                          <div class="row-fluid" style="margin-bottom: 5px;">
                            <div class="row-fluid" style="margin-bottom: 5px">
                              <div class="span6"></div>
                              <div class="span6" style="background-color: #fff; padding: 2.5%; border-radius: 5px;" id="msisdnParent">
                                <div class="row-fluid" id="radioMSISDN">

                                <input type="hidden" value=<?php echo $secondarymsisdn; ?> name="secondaryMSISDN" >
                                <label class="contaRadio" style="display: none; overflow: hidden;"><?php echo $secondarymsisdn; ?><input id="secondaryMSISDN0" type="radio" name="secondaryMSISDN"  checked="checked" value="<?php echo $secondarymsisdn; ?>"><span class="checkmark"></span></label>
                                <!--
                                    <span>
                                        <input id="secondaryMSISDN1" name="secondaryMSISDN" class="radioSelectItemCustom radio-inline radio inline control-label radioSelectItem " type="radio" >
                                        <label class="nomorcantik" for="msisdn1">?????</label></span>
                                    <span>
                                        <input id="secondaryMSISDN2" name="secondaryMSISDN" class="radioSelectItemCustom radio-inline radio inline control-label radioSelectItem " type="radio" >
                                        <label class="nomorcantik" for="msisdn2">?????</label></span>
                                    <span>
                                        <input id="secondaryMSISDN3" name="secondaryMSISDN" class="radioSelectItemCustom radio-inline radio inline control-label radioSelectItem " type="radio" >
                                        <label class="nomorcantik" for="msisdn3">?????</label></span>
                                    <span>
                                        <input id="secondaryMSISDN4" name="secondaryMSISDN" class="radioSelectItemCustom radio-inline radio inline control-label radioSelectItem " type="radio" >
                                        <label class="nomorcantik" for="msisdn4">?????</label></span>
                                    <span>
                                        <input id="secondaryMSISDN5" name="secondaryMSISDN" class="radioSelectItemCustom radio-inline radio inline control-label radioSelectItem " type="radio" >
                                        <label class="nomorcantik" for="msisdn5">?????</label></span>
                                -->
                                </div>

                                <div class="row-fluid">
                                  <!--
                                  <div id="paging2" ></div> 
                                  
                                    <div class="span6" id="msisdnWrap2" style="display: none;">
                                        <a href="javascript:void(0)" onclick="getSearchNumber(&#39;prev&#39;)">
                                            <div style="float: left; width: 15%; margin-top: 10px">
                                                <i class="fa fa-angle-left fa-lg"></i>
                                            </div>
                                            <div style="float: left; width: 75%; margin-top: 6px">
                                                Sebelumnya
                                            </div>
                                        </a>
                                    </div>
                                    <div class="span6" id="msisdnWrap3">
                                        <a href="javascript:void(0)" onclick="getSearchNumber(&#39;next&#39;)">
                                            <div style="float: right; width: 15%; margin-top: 10px">
                                                <i class="fa fa-angle-right fa-lg"></i>
                                            </div>
                                            <div style="float: right; width: 75%; margin-top: 6px;">
                                                <div style="float: right; width: 85%;">
                                                    Selanjutnya
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    -->
                                </div>
                                <hr style="display: none;">
                                <span id="ketpilih" style="font-family: &#39;Titillium Web&#39;, sans-serif; font-size: 13px; line-height: 19px">Cari nomor yang mengandung angka cantik yang Anda ketikan</span>
                                <br>
                                <?php if($secondarymsisdn !== ""){ ?>
                                <span id="currentNo" style="font-family: 'Helvetica-Bold', sans-serif; font-size: 13px; line-height: 19px">Nomor yang dipilih sekarang <?php echo $secondarymsisdn; ?></span><?php } ?>
                                <!--<input type="hidden" value=<?php echo $secondarymsisdn; ?> name="secondaryMSISDN" >-->
                                  <!--<span style="font-family: &#39;Titillium Web&#39;, sans-serif; font-size: 13px; line-height: 19px">Pilih nomor kartuHalo yang Anda inginkan.</span>-->
                              </div>
                            </div>
                          </div>

                          <div class="row-fluid" style="margin-bottom: 1px;">
                            <div class="span6" style="margin-bottom: 1px;"></div>
                            <div class="span6" style="margin-bottom: 1px;">
                              <div style="width: 90%; float: left"></div>
                            </div>
                          </div>
                          <!-- END INPUT CARI NOMOR -->

                          <!-- INPUT PACKAGE TYPE -->
                          <div class="row-fluid" style="margin-bottom: 5px">
                            <div class="span6">
                              <div style="width: 90%; float: left">
                                Pilih Paket<span style="color:#de0300"><b>*</b></span>
                                <br> <span style="font-family: &#39;Titillium Web&#39;, sans-serif; font-size: 13px; line-height: 18px;"><i>(Paket kartuHalo disesuaikan sesuai region)</i></span>
                              </div>
                              <div style="width: 10%; float: left">:</div>
                            </div>

                            <div class="span6" style="background-color: #fff; padding: 1% 1% 1% 2.5%; border-radius: 3px;">
                                <span id="ketpilihz" style="font-family: &#39;Titillium Web&#39;, sans-serif; font-size: 13px">Silakan pilih paket untuk kartuHalo Anda</span>
                                <?php if($packagetype !== ""){ ?>
                                <p><span id="currentPack" style="font-family: 'Helvetica-Bold', sans-serif; font-size: 13px; line-height: 19px">Paket yang Anda pilih sekarang <?php echo $packagetype; ?></span><?php } ?></p>
                            </div>

                            <div class="span12" style="margin-left: 0;">

                              <div class="package-list">
                                <input type="hidden" value="<?php echo $packagetypez.'|'.$packagetype; ?>" name="packagetype" >
                                <label class="D1" style="display: none; overflow: hidden;"><?php echo $packagetype; ?><input type="radio" name="packagetype"  checked="checked" value="<?php echo $packagetypez."|".$packagetype; ?>"><span class="checkmark"></span></label>
                                <!-- 
                                    <div class="D1 selected">
                                        <input class="paketku" type="radio" name="packagetype" value="550" checked="checked">
                                        <div class="D2">
                                          <h5>HaloKick</h5>
                                        </div>

                                        <div class="numerical price medium" data-currency="Rp" data-decimal=".000" style="margin-top:10px;margin-bottom: 20px;">550</div>

                                        <div class="table-div">

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Internet</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                8<sup>GB</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Internet Email</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                600<sup>MB</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Call CUG</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                1000<sup>mins</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Call All Operator</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                60<sup>mins</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>SMS CUG</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                1000<sup>SMS</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>SMS All Operator</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                60<sup>SMS</sup>
                                              </div>
                                            </div>
                                          </div>

                                        </div>
                                    </div>
                                    
                                    <div class="D1">
                                        <input class="paketku" type="radio" name="packagetype" value="330">
                                        <div class="D2">
                                          <h5>HaloPunch</h5>
                                        </div>

                                        <div class="numerical price medium" data-currency="Rp" data-decimal=".000" style="margin-top:10px;margin-bottom: 20px;">330</div>

                                        <div class="table-div">

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Internet</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                8<sup>GB</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Internet Email</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                600<sup>MB</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Call CUG</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                1000<sup>mins</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Call All Operator</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                60<sup>mins</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>SMS CUG</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                1000<sup>SMS</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>SMS All Operator</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                60<sup>SMS</sup>
                                              </div>
                                            </div>
                                          </div>

                                        </div>
                                    </div>

                                    <div class="D1">
                                        <input class="paketku" type="radio" name="packagetype" value="990">
                                        <div class="D2">
                                          <h5>HaloHaloBdg</h5>
                                        </div>

                                        <div class="numerical price medium" data-currency="Rp" data-decimal=".000" style="margin-top:10px;margin-bottom: 20px;">990</div>

                                        <div class="table-div">

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Internet</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                8<sup>GB</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Internet Email</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                600<sup>MB</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Call CUG</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                1000<sup>mins</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Call All Operator</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                60<sup>mins</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>SMS CUG</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                1000<sup>SMS</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>SMS All Operator</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                60<sup>SMS</sup>
                                              </div>
                                            </div>
                                          </div>

                                        </div>
                                    </div>
                                
                                    <div class="D1">
                                        <input class="paketku" type="radio" name="packagetype" value="330">
                                        <div class="D2">
                                          <h5>HaloBro</h5>
                                        </div>

                                        <div class="numerical price medium" data-currency="Rp" data-decimal=".000" style="margin-top:10px;margin-bottom: 20px;">330</div>

                                        <div class="table-div">

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Internet</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                8<sup>GB</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Internet Email</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                600<sup>MB</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Call CUG</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                1000<sup>mins</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Call All Operator</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                60<sup>mins</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>SMS CUG</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                1000<sup>SMS</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>SMS All Operator</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                60<sup>SMS</sup>
                                              </div>
                                            </div>
                                          </div>

                                        </div>
                                    </div>
                                
                                    <div class="D1">
                                        <input class="paketku" type="radio" name="packagetype" value="990">
                                        <div class="D2">
                                          <h5>HaloCoy</h5>
                                        </div>

                                        <div class="numerical price medium" data-currency="Rp" data-decimal=".000" style="margin-top:10px;margin-bottom: 20px;">990</div>

                                        <div class="table-div">

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Internet</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                8<sup>GB</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Internet Email</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                600<sup>MB</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Call CUG</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                1000<sup>mins</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Call All Operator</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                60<sup>mins</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>SMS CUG</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                1000<sup>SMS</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>SMS All Operator</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                60<sup>SMS</sup>
                                              </div>
                                            </div>
                                          </div>

                                        </div>
                                    </div>
                                
                                    <div class="D1">
                                        <input class="paketku" type="radio" name="packagetype" value="990">
                                        <div class="D2">
                                          <h5>HaloFCKER</h5>
                                        </div>

                                        <div class="numerical price medium" data-currency="Rp" data-decimal=".000" style="margin-top:10px;margin-bottom: 20px;">990</div>

                                        <div class="table-div">

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Internet</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                8<sup>GB</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Internet Email</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                600<sup>MB</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Call CUG</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                1000<sup>mins</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Call All Operator</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                60<sup>mins</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>SMS CUG</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                1000<sup>SMS</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>SMS All Operator</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                60<sup>SMS</sup>
                                              </div>
                                            </div>
                                          </div>

                                        </div>
                                    </div>
                                
                                    <div class="D1">
                                        <input class="paketku" type="radio" name="packagetype" value="330">
                                        <div class="D2">
                                          <h5>HaloCUK</h5>
                                        </div>

                                        <div class="numerical price medium" data-currency="Rp" data-decimal=".000" style="margin-top:10px;margin-bottom: 20px;">330</div>

                                        <div class="table-div">

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Internet</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                8<sup>GB</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Internet Email</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                600<sup>MB</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Call CUG</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                1000<sup>mins</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Call All Operator</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                60<sup>mins</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>SMS CUG</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                1000<sup>SMS</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>SMS All Operator</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                60<sup>SMS</sup>
                                              </div>
                                            </div>
                                          </div>

                                        </div>
                                    </div>
                                
                                    <div class="D1">
                                        <input class="paketku" type="radio" name="packagetype" value="990">
                                        <div class="D2">
                                          <h5>HaloPal</h5>
                                        </div>

                                        <div class="numerical price medium" data-currency="Rp" data-decimal=".000" style="margin-top:10px;margin-bottom: 20px;">990</div>

                                        <div class="table-div">

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Internet</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                8<sup>GB</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Internet Email</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                600<sup>MB</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Call CUG</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                1000<sup>mins</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Call All Operator</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                60<sup>mins</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>SMS CUG</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                1000<sup>SMS</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>SMS All Operator</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                60<sup>SMS</sup>
                                              </div>
                                            </div>
                                          </div>

                                        </div>
                                    </div>
                                 -->

                              </div><!---->


                              <!--<div class="packagelist">
                                <div><input class="dummy" type="hidden" name="packagetype" value="1" />1</div>
                                <div><input class="dummy" type="hidden" name="packagetype" value="2" />2</div>
                                <div><input class="dummy" type="hidden" name="packagetype" value="3" />3</div>
                                <div><input class="dummy" type="hidden" name="packagetype" value="xxx" />4</div>
                              </div>-->

                              <!--
                              <div class="calendar">
                                
                                
                                    <input class="dummy" type="radio" name="packagetype" value="1">
                                    <div class="D1">

                                        <div class="D2">
                                          <h5>HaloKick</h5>
                                        </div>

                                        <div class="numerical price medium" data-currency="Rp" data-decimal=".000" style="margin:20px 0;">550</div>

                                        <div class="table-div">

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Internet</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                8<sup>GB</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Internet Email</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                600<sup>MB</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Call CUG</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                1000<sup>mins</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Call All Operator</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                60<sup>mins</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>SMS CUG</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                1000<sup>SMS</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>SMS All Operator</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                60<sup>SMS</sup>
                                              </div>
                                            </div>
                                          </div>

                                        </div>
                                    </div>
                                

                                
                                    <input class="dummy" type="radio" name="packagetype" value="2">
                                    <div class="D1">

                                        <div class="D2">
                                          <h5>HaloPunch</h5>
                                        </div>

                                        <div class="numerical price medium" data-currency="Rp" data-decimal=".000" style="margin:20px 0;">550</div>

                                        <div class="table-div">

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Internet</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                8<sup>GB</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Internet Email</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                600<sup>MB</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Call CUG</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                1000<sup>mins</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Call All Operator</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                60<sup>mins</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>SMS CUG</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                1000<sup>SMS</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>SMS All Operator</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                60<sup>SMS</sup>
                                              </div>
                                            </div>
                                          </div>

                                        </div>
                                    </div>
                                

                                
                                    <input class="dummy" type="radio" name="packagetype" value="999">
                                    <div class="D1">

                                        <div class="D2">
                                          <h5>HaloHaloBdg</h5>
                                        </div>

                                        <div class="numerical price medium" data-currency="Rp" data-decimal=".000" style="margin:20px 0;">550</div>

                                        <div class="table-div">

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Internet</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                8<sup>GB</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Internet Email</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                600<sup>MB</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Call CUG</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                1000<sup>mins</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>Call All Operator</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                60<sup>mins</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>SMS CUG</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                1000<sup>SMS</sup>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row row-0">
                                            <div class="thead">
                                              <span>SMS All Operator</span>
                                            </div>
                                             
                                            <div class="tbody">
                                              <div class="numericcc">
                                                60<sup>SMS</sup>
                                              </div>
                                            </div>
                                          </div>

                                        </div>
                                    </div>

                              </div>-->

                            </div>
                              

                              <!--
                              <span>
                                <input id="packageType1" name="packagetype" class="radio inline control-label radioSelectItem" onchange="selectPackage(this)" type="radio" value="1">
                                <label for="packageType1">Basic</label></span>
                              <span>
                                <input id="packageType2" name="packagetype" class="radio inline control-label radioSelectItem" onchange="selectPackage(this)" type="radio" value="2">
                                <label for="packageType2">Intermediate</label></span>
                              <span>
                                <input id="packageType3" name="packagetype" class="radio inline control-label radioSelectItem" onchange="selectPackage(this)" type="radio" value="3">
                                <label for="packageType3">Advance</label></span>
                              -->


                            
                          </div>
                          <!-- END INPUT PACKAGE TYPE -->
                        </div> <!-- END showMeLater -->
                        </div>  <!-- END CONTAINER ALAMAT GEDUNG, CARI NOMOR , TYPE PACKAGE -->


                        <!-- HEADER DATA DIRI -->
                        <div class="row-fluid" style="margin-bottom: 10px">
                          <div style="width: 15%; float: left"><img src="<?php echo base_url() ?>asset/Customer_Service_Online_files/input_datadiri.png" border="0"></div>
                          <div style="width: 85%; float: left">
                            <legend style="text-align: right">
                              <span style="font-family: &#39;Titillium Web&#39;, sans-serif; font-size: 18px; font-weight: 400; color: #666;">DATA <span style="color:#de0300">DIRI</span></span>
                            </legend>
                          </div>
                        </div>


                        <!-- CONTAINER KTP NIP KK -->
                        <div style="padding: 0 7.5%; font-family: &#39;Titillium Web&#39;, sans-serif; font-size: 15px; font-weight: 400; color: #666; margin-bottom: 5%">

                          <!-- INPUT KTP -->
                          <div class="row-fluid" style="margin-bottom: 5px">
                            <div class="span6">
                              <div style="width: 90%; float: left">
                                Nomor KTP
                                <span style="color: #de0300"><b>*</b></span>
                              </div>
                              <div style="width: 10%; float: left">:</div>
                            </div>

                            <div class="span6">
                              <input id="noKTP" name="noktp" class="inputCustome" placeholder="Isi dengan nomor KTP" type="text" value="<?php echo $noktp;?>" maxlength="16" pattern="[0-9]*" >
                              <!-- <br> <br> -->
                              <div class="row-fluid" style="margin-bottom: 5px">
                                <input class="span8" type="file" name="imagektp" id="imageKTP">
                              </div>
                              <div class="row-fluid" style="margin-bottom: 5px">
                                <span class="span8" style="background-color: #fff; padding: 2.5%;">Format: jpg, png, atau gif. Maks.: 3MB</span>
                              </div>
                            </div>

                            <div class="row-fluid" style="margin-bottom: 1px;">
                              <div class="span6" style="margin-bottom: 1px;"></div>
                              <div class="span6" style="margin-bottom: 1px;">
                                <div style="width: 90%; float: left"></div>
                              </div>
                            </div>
                          </div>
                          <!-- END INPUT KTP -->

                          <!-- INPUT NIP -->
                          <div class="row-fluid" style="margin-bottom: 5px">
                            <div class="span6">
                              <div style="width: 90%; float: left">
                                Kartu Identitas Karyawan
                                <span style="color: #de0300"><b>*</b></span>
                              </div>
                              <div style="width: 10%; float: left">:</div>
                            </div>

                            <div class="span6">
                              <div class="row-fluid" style="margin-bottom: 5px">
                                <input class="span8" type="file" name="imagepeg" id="imagePeg">
                              </div>
                              <div class="row-fluid" style="margin-bottom: 5px">
                                <span class="span8" style="background-color: #fff; padding: 2.5%;">Format: jpg, png, atau gif. Maks.: 3MB</span>
                              </div>
                            </div>

                            <div class="row-fluid" style="margin-bottom: 1px;">
                              <div class="span6" style="margin-bottom: 1px;"></div>
                              <div class="span6" style="margin-bottom: 1px;">
                                <div style="width: 90%; float: left"></div>
                              </div>
                            </div>
                          </div>
                          <!-- END INPUT NIP -->

                          <!-- INPUT KK -->
                          <div class="row-fluid" style="margin-bottom: 5px">
                            <div class="span6">
                              <div style="width: 90%; float: left">
                                Nomor Kartu Keluarga
                                <span style="color: #de0300"><b>*</b></span><br> <span style="font-family: &#39;Titillium Web&#39;, sans-serif; font-size: 13px; line-height: 18px;"><i>(Berdasarkan Peraturan Menkominfo)</i></span>
                              </div>
                              <div style="width: 10%; float: left">:</div>
                            </div>

                            <div class="span6">
                              <input id="noKK" name="nokk" class="inputCustome" maxlength="16" pattern="[0-9]*" placeholder="Isi dengan nomor Kartu Keluarga" type="text" value="<?php echo $nokk; ?>" >
                            </div>

                            <div class="row-fluid" style="margin-bottom: 1px;">
                              <div class="span6" style="margin-bottom: 1px;"></div>
                              <div class="span6" style="margin-bottom: 1px;">
                                <div style="width: 90%; float: left"></div>
                              </div>
                            </div>

                            <div class="row-fluid" style="margin-bottom: 1px;">
                              <div class="span6" style="margin-bottom: 1px;"></div>
                              <div class="span6" style="margin-bottom: 1px;">
                                <div style="width: 90%; float: left"></div>
                              </div>
                            </div>

                            <div class="row-fluid" style="margin-bottom: 5px">
                              <div class="span12">
                                <span style="color: #de0300"><b>*</b> Wajib Diisi</span>
                              </div>
                            </div>
                            <div class="row-fluid" style="margin-bottom: 5px">
                              <div class="span12">
                                <span style="color: #de0300"><b></b> Pastikan semua data telah benar</span>
                              </div>
                            </div>
                          </div>

                          <div class="row-fluid" style="float: right">
                            <div style="margin-bottom: 1px;"></div>
                            <div style="margin-bottom: 1px;">
                              <div style="float: right"></div>
                            </div>
                          </div>
                          <!-- END INPUT KK -->

                          <a class="btn-large btn-primary nextz" style="cursor:pointer;text-align:center;font-family: &#39;Titillium Web&#39;, sans-serif; font-size: 15px; width: 250px; margin-top: 20px; float: right">LANJUT</a>

                        </div>  <!-- END CONTAINER KTP NIP KK -->


                      </fieldset> <!-- FIELDSET 1 ENDS -->


                      <!-- FIELDSET 2 START -->
                      <fieldset id="halaman2">

                        <!-- HEADER DATA DIRI -->
                        <div class="row-fluid" style="margin-bottom: 10px">
                          <div style="width: 15%; float: left">
                            <img src="<?php echo base_url() ?>asset/Customer_Service_Online_files/input_datadiri.png" border="0">
                          </div>
                          <div id="scrollHere2" style="width: 85%; float: left">
                            <legend style="text-align: right">
                              <span style="font-family: &#39;Titillium Web&#39;, sans-serif; font-size: 18px; font-weight: 400; color: #666;">DATA <span style="color:#de0300">DIRI</span></span>
                            </legend>
                          </div>
                        </div>


                        <!-- CONTAINER NAMA,ALAMAT,TTL -->
                        <div style="padding: 0 7.5%; font-family: &#39;Titillium Web&#39;, sans-serif; font-size: 15px; font-weight: 400; color: #666; margin-bottom: 5%">

                          <!-- INPUT NAMA -->
                          <div class="row-fluid" style="margin-bottom: 5px">
                            <div class="span6">
                              <div style="width: 90%; float: left">
                                Nama
                                <span style="color: #de0300"><b>*</b></span><br> <span style="font-family: &#39;Titillium Web&#39;, sans-serif; font-size: 13px; line-height: 18px;"><i>(sesuai KTP)</i></span>
                              </div>
                              <div style="width: 10%; float: left">:</div>
                            </div>
                            <div class="span6">
                              <input id="fullName" name="fullname" class="inputCustome" placeholder="Isi dengan nama lengkap" type="text" value="<?php echo $fullname;?>" maxlength="100">
                            </div>
                          </div>

                          <div class="row-fluid" style="margin-bottom: 1px;">
                            <div class="span6" style="margin-bottom: 1px;"></div>
                            <div class="span6" style="margin-bottom: 1px;">
                              <div style="width: 90%; float: left"></div>
                            </div>
                          </div>
                          <!-- END INPUT NAMA -->

                          <!-- INPUT ALAMAT -->
                          <div class="row-fluid" style="margin-bottom: 5px;" id="alamatPengantaran">
                            <div class="row-fluid" style="margin-bottom: 5px">
                              <div class="span6">
                                <div style="width: 90%; float: left">
                                  Alamat
                                  <span style="color: #de0300"><b>*</b></span><br> <span style="font-family: &#39;Titillium Web&#39;, sans-serif; font-size: 13px; line-height: 18px;"><i>(sesuai KTP)</i></span>
                                </div>
                            
                                <div style="width: 10%; float: left">:</div>
                                
                              </div>
                              <div class="span6">
                                <input id="alamat" name="deliveryaddress" class="inputCustome" placeholder="Isi dengan alamat sesuai KTP" type="text" value="<?php echo $alamat;?>" maxlength="127">
                              
                              <div class="row-fluid" style="margin-bottom: 5px">
                                  <select class="selectItem" id="provinces" name="deliveryprovince" onchange="onChangeDeliveryState()" required >
                                    <!--<option value="">Provinsi</option><option value="1">Aceh</option><option value="17">Bali</option><option value="11">Banten</option><option value="7">Bengkulu</option><option value="14">DI Yogyakarta</option><option value="12">DKI Jakarta</option><option value="25">Gorontalo</option><option value="8">Jambi</option><option value="13">Jawa Barat</option><option value="15">Jawa Tengah</option><option value="16">Jawa Timur</option><option value="20">Kalimantan Barat</option><option value="21">Kalimantan Selatan</option><option value="22">Kalimantan Tengah</option><option value="23">Kalimantan Timur</option><option value="24">Kalimantan Utara</option><option value="6">Kep. Bangka-Belitung</option><option value="3">Kepulauan Riau</option><option value="9">Lampung</option><option value="26">Maluku</option><option value="27">Maluku Utara</option><option value="18">Nusa Tenggara Barat</option><option value="19">Nusa Tenggara Timur</option><option value="28">Papua</option><option value="29">Papua Barat</option><option value="4">Riau</option><option value="30">Sulawesi Barat</option><option value="31">Sulawesi Selatan</option><option value="32">Sulawesi Tengah</option><option value="33">Sulawesi Tenggara</option><option value="34">Sulawesi Utara</option><option value="5">Sumatera Barat</option><option value="10">Sumatera Selatan</option><option value="2">Sumatera Utara</option>-->
                                    <option value="">Provinsi</option>

                                      <?php foreach ($prov as $prov){ ?>
                                        <option value="<?php echo $prov->provinsi;?>" <?php echo (isset($provinsi)&&$provinsi==$prov->provinsi) ? 'selected="selected"':''; ?> ><?php echo $prov->provinsi;?></option>
                                      <?php } ?>

                                      <?php //foreach ($prov as $prov){ ?>
                                        <!--<option value="<?php echo $prov->provinsi;?>"><?php echo $prov->provinsi;?></option>';-->
                                      <?php //} ?>
                                  </select>

                                  <select id="cities" name="deliverycity" style="font-family:&#39;Titillium Web&#39;,sans-serif;width:100%;height:40px;" required >
                                    <!--<option value="">Kota</option><option value="1">Kota A</option><option value="2">Kota B</option><option value="3">Kota C</option><option value="">Kota</option>
                                    <option value="">Kota</option>
                                    <option value=<?php echo $kota; ?> <?php echo (isset($kota)&&$kota!="") ? 'selected="selected"':''; ?> ><?php echo $kota; ?></option>-->

                                    <option value="">Kota</option>
                                    <?php for($z=0 ; $z<count($kotaku);$z++){ ?>
                                      <option value="<?php echo $kotaku[$z]['kota']; ?>" <?php echo (isset($kota)&&$kota==$kotaku[$z]['kota']) ? 'selected="selected"':''; ?> ><?php echo $kotaku[$z]['kota']; ?> </option>
                                    <?php } ?>

                                  </select>

                                  <input id="kodePos" name="kodepos" class="inputCustome" placeholder="Kode Pos" type="text" value="<?php echo $kodepos;?>" pattern="[0-9]*" maxlength="5">
                              </div>
                              
                              </div>
                              
                            </div>

                            <div class="row-fluid" style="margin-bottom: 1px;">
                              <div class="span6" style="margin-bottom: 1px;"></div>
                              <div class="span6" style="margin-bottom: 1px;">
                                <div style="width: 90%; float: left"> </div>
                              </div>
                            </div>
                            
                          </div>
                          <!-- END INPUT ALAMAT -->

                          <!-- INPUT TL -->
                          <div class="row-fluid" style="margin-bottom: 5px">
                            <div class="span6">
                              <div style="width: 90%; float: left">
                                Tempat Lahir
                                <span style="color: #de0300"><b>*</b></span>
                              </div>
                              <div style="width: 10%; float: left">:</div>
                            </div>
                            <div class="span6">
                              <input id="birthplace" name="birthplace" class="inputCustome" placeholder="Isi dengan tempat lahir" type="text" value="<?php echo $tempatlahir;?>" maxlength="100">
                            </div>
                          </div>

                          <div class="row-fluid" style="margin-bottom: 1px;">
                            <div class="span6" style="margin-bottom: 1px;"></div>
                            <div class="span6" style="margin-bottom: 1px;">
                              <div style="width: 90%; float: left"> </div>
                            </div>
                          </div>
                          <!-- END INPUT TL -->

                          <!-- INPUT TANGGAL LAHIR -->
                          <div class="row-fluid" style="margin-bottom: 5px">
                            <div class="span6">
                              <div style="width: 90%; float: left">
                                Tanggal Lahir
                                <span style="color: #de0300"><b>*</b></span>
                              </div>
                              <div style="width: 10%; float: left">:</div>
                            </div>
                            <div class="span6">
                              <select id="date" name="date" class="selectItemCalendar">
                              <?php
                              
                                for ($day = 1; $day <= 31; $day++) 
                                {
                                    if($day >=1 and $day <10) { ?>
                                    <option value=<?php echo $day; ?> <?php echo (isset($exxx[2])&&$exxx[2]==$day) ? 'selected="selected"':''; ?> >0<?php echo $day; ?></option>

                                   <?php }else{ ?>

                                    <option value=<?php echo $day; ?> <?php echo (isset($exxx[2])&&$exxx[2]==$day) ? 'selected="selected"':''; ?> ><?php echo $day; ?></option>
                                    <?php }
                                }
                              
                              //else{$selectMe = 'selected="selected"';$d = substr($tanggalLahir,0,2);echo "<option value=\"$d\" $selectMe>$d</option>\n";}
                              ?>
                              </select>

                              <select id="month" name="month" class="selectItemCalendar">
                              <?php
                                $months = array (1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',   'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                                 foreach ($months as $key => $value) { ?>
                                <option value=<?php echo $key; ?> <?php echo (isset($exxx[1])&&$exxx[1]==$key) ? 'selected="selected"':''; ?> ><?php echo $value; ?></option>
                              <?php } ?>
                              </select>
                              
                              <select id="year" name="year" class="selectItemCalendar">
                              <?php
                                for ($year = date('Y')-52; $year <= date("Y"); $year++) 
                              {?>
                                <option value=<?php echo $year; ?> <?php echo (isset($exxx[0])&&$exxx[0]==$year) ? 'selected="selected"':''; ?> ><?php echo $year; ?></option>
                              <?php } ?>
                              </select>
                            </div>
                            
                          </div>
                          <!-- END INPUT TANGGAL LAHIR -->

                        </div>  <!-- END CONTAINER NAMA,ALAMAT,TTL -->

                        <!-- HEADER INFORMASI LAIN -->
                        <div class="row-fluid" id="halo" style="margin-bottom: 10px">
                          <div style="width: 15%; float: left">
                            <img src="<?php echo base_url() ?>asset/Customer_Service_Online_files/input_datadiri.png" border="0">
                          </div>
                          <div style="width: 85%; float: left">
                            <legend style="text-align: right">
                              <span style="font-family: &#39;Titillium Web&#39;, sans-serif; font-size: 18px; font-weight: 400; color: #666;">INFORMASI <span style="color:#de0300">LAIN</span></span>
                            </legend>
                          </div>
                        </div>

                        <!-- CONTAINER IBU, TELPON LAIN , EMAIL REF -->
                        <div id="halo2" style="padding: 0 7.5%; font-family: &#39;Titillium Web&#39;, sans-serif; font-size: 15px; font-weight: 400; color: #666; margin-bottom: 5%">

                          <!-- INPUT IBU -->
                          <div class="row-fluid" style="margin-bottom: 5px">
                            <div class="span6">
                              <div style="width: 90%; float: left">
                                Nama Ibu Kandung
                                <span style="color: #de0300"><b>*</b></span><br> <span style="font-family: &#39;Titillium Web&#39;, sans-serif; font-size: 13px; line-height: 18px;"></span>
                              </div>
                              <div style="width: 10%; float: left">:</div>
                            </div>
                            <div class="span6">
                              <input id="ibuName" name="ibuname" class="inputCustome" placeholder="Isi dengan nama ibu kandung" type="text" value="<?php echo $namaibu; ?>" maxlength="100">
                            </div>
                          </div>
                          <div class="row-fluid" style="margin-bottom: 1px;">
                            <div class="span6" style="margin-bottom: 1px;"></div>
                            <div class="span6" style="margin-bottom: 1px;">
                              <div style="width: 90%; float: left">
                                
                              </div>
                            </div>
                          </div>
                          <!-- END INPUT IBU -->

                          <!-- INPUT TELPON LAIN -->
                          <div class="row-fluid" style="margin-bottom: 5px">
                            <div class="span6">
                              <div style="width: 90%; float: left">
                                Nomor Lain Yang Dapat Dihubungi
                                <span style="color: #de0300"><b>*</b></span><br> <span style="font-family: &#39;Titillium Web&#39;, sans-serif; font-size: 13px; line-height: 18px;"><i>(handphone/kantor/rumah)</i></span>
                              </div>
                              <div style="width: 10%; float: left">:</div>
                            </div>
                            <div class="span6">
                              <!--<select id="phonetype" name="phonetype" class="selectItem">
                                <option value="3">No. Handphone</option>
                                <option value="2">No. Kantor</option>
                                <option value="1">No. Rumah</option>
                              </select>-->
                              <input id="phoneNo" name="phoneno" class="inputCustome" placeholder="Isi dengan nomor yang dapat dihubungi" type="text" value="<?php echo $phone;?>" maxlength="50" pattern="[0-9]*">
                            </div>
                          </div>
                          
                          <div class="row-fluid" style="margin-bottom: 1px;">
                            <div class="span6" style="margin-bottom: 1px;"></div>
                            <div class="span6" style="margin-bottom: 1px;">
                              <div style="width: 90%; float: left"></div>
                            </div>
                          </div>
                          <!-- END INPUT TELPON LAIN -->

                          <!-- INPUT EMAIL REF -->
                          <div class="row-fluid" style="margin-bottom: 5px">
                            <div class="span6">
                              <div style="width: 90%; float: left">
                                Email referensi
                                <span style="color: #de0300"><b></b></span><br> <span style="font-family: &#39;Titillium Web&#39;, sans-serif; font-size: 13px; line-height: 18px;"></span>
                              </div>
                              <div style="width: 10%; float: left">:</div>
                            </div>
                            <div class="span6">
                              <input id="emailRef" name="emailref" class="inputCustome" placeholder="Isi apabila memiliki alamat email pemberi referensi" type="email" value="<?php echo $emailreferensi;?>" maxlength="100">
                            </div>
                          </div>

                          <div class="row-fluid" style="margin-bottom: 1px;">
                            <div class="span6" style="margin-bottom: 1px;"></div>
                            <div class="span6" style="margin-bottom: 1px;">
                              <div style="width: 90%; float: left"></div>
                            </div>
                          </div>
                          <!-- END INPUT EMAIL REF -->

                          <div class="row-fluid" style="margin-bottom: 1px;">
                            <div class="span6" style="margin-bottom: 1px;"></div>
                            <div class="span6" style="margin-bottom: 1px;">
                              <div style="width: 90%; float: left"></div>
                            </div>
                          </div>

                          <div class="row-fluid" style="margin-bottom: 5px">
                            <div class="span12">
                              <span style="color: #de0300"><b>*</b> Wajib Diisi</span>
                            </div>
                          </div>
                          <div class="row-fluid" style="margin-bottom: 5px">
                            <div class="span12">
                              <span style="color: #de0300"><b></b> Pastikan semua data telah benar</span>
                            </div>
                          </div>

                          <div class="row-fluid" style="float: right">
                            <div style="margin-bottom: 1px;"></div>
                            <div style="margin-bottom: 1px;">
                              <div style="float: right"></div>
                            </div>
                          </div>

                        </div> <!-- END CONTAINER IBU, TELPON LAIN , EMAIL REF -->

                        <a class="btn-large btn-primary backz" style="text-align:center;font-family: &#39;Titillium Web&#39;, sans-serif; font-size: 15px;cursor:pointer;width: 250px; margin-top: 20px; float: left">KEMBALI</a>
                        <!--<a class="btn-large btn-primary nextz" style="text-align:center;font-family: &#39;Titillium Web&#39;, sans-serif; font-size: 15px; width: 250px; margin-top: 20px; float: right">LANJUT</a>-->
                        <input class="btn-large btn-primary nextz" style="text-align:center;font-family: &#39;Titillium Web&#39;, sans-serif; font-size: 15px;cursor:pointer;width: 250px; margin-top: 20px; float: right" type="submit" value="LANJUT" />

                      </fieldset> <!-- FIELDSET 2 ENDS -->




                    </form>


                  </div> <!-- END padding 5% 2.5% -->






				</div> <!-- END width 100% -->
              </div> <!-- END span12 -->










            </div>  <!-- END maxWidth DALEM -->

          </div> <!-- END row-fluid DALEM -->

        </div> <!-- END container-fluid fullWidth -->

      </div> <!-- END contentInDiv -->
    
    </div>  <!-- END maxWidth -->

  </div>    <!-- END row - fluid -->



</div> <!-- END CONTENT CONTAINER -->
	
	<!-- MY JQUERY TAMBAHAN -->

        <!-- JAVASCRIPT FOR FORM VALIDATION ALL INPUT TYPES -->
		<script type="text/javascript">
			$(document).ready(function(){
				// Custom method validate username
				$.validator.addMethod("nomorRegex", function(value, element) {
					return this.optional(element) || /^[0-9]*$/i.test(value);
				}, "Nomor Kartu must contain only numbers");
				// Custom method validate username
				$.validator.addMethod('filesize', function (value, element, param) {
				    return this.optional(element) || (element.files[0].size <= param)
				}, 'The file you are trying to upload is too large (max {0}MB)');
                // Custom method validate BirthDate
                $.validator.addMethod('validDate', function (value, element) {
                    var pain = ($('#year').val()+'-'+$('#month').val()+'-'+$('#date').val());
                    return this.optional(element) || moment(pain, 'YYYY-M-D', true).isValid();
                }, 'Please pick valid date');
                $.validator.addMethod("strictemail", function(value, element) {
                    var valid = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/i.test(value);
                    if (value == "") return true;
                        return valid;
                }, "Please enter a valid email address.");

				// Validator
				$(".nextz").click(function(){
                    if ($("input[name=alamatkantor]:checked").length == 0){$('html, body').animate({scrollTop: $("input[name=alamatkantor]").offset().top-300}, 2000);  $('#example_wrapper').animate({"border-width": "2px"}, 500);}
                    else if($("input[name=secondaryMSISDN]:checked").length == 0){window.alert("Please choose your Halo Number !"); $('html, body').animate({scrollTop: $("#primaryMSISDN").offset().top-200}, 2000);$('#primaryMSISDN').focus(); }
                    //else if($("input[name=secondaryMSISDN]").length < 2){window.alert("Please choose your Halo Number !"); $('html, body').animate({scrollTop: $("#primaryMSISDN").offset().top-200}, 2000);$('#primaryMSISDN').focus(); }
                    else if ($("input[name=packagetype]:checked").length == 0){window.alert("Please choose your package type !"); $('html, body').animate({scrollTop: $(".package-list").offset().top}, 2000); }
                    //window.alert("Please choose your office address !");

                    else{

                    // Custom method validate DUKCAPIL
                    if( $('#noKTP').val() && $('#noKK').val() )
                    { 
                        var ktp=$('#noKTP').val();   var kk=$('#noKK').val();
                        
                        var jqXHR=$.ajax({
                          url: "<?php echo base_url('registrasi/API_Dukcapil'); ?>",
                          type: "POST",
                          data: {ktp: ktp, kk: kk},
                          async: false
                        }); 

                        console.log(jqXHR.responseText.trim());
                        var isCapil = ( jqXHR.responseText.trim() == 'Something went wrong...\n0000 - Success' );
                        if( isCapil === false ) {alert(jqXHR.responseText.trim());}
                    } //END IF AJAX  // MAININ RESPONSE ALERT DAN ISEMPTY

					var form = $("#registerForm");
					form.validate({
						errorElement: 'span',
						errorClass: 'help-block',
						highlight: function(element, errorClass, validClass) {
							$(element).closest('.span6').addClass("has-error");
						},
						unhighlight: function(element, errorClass, validClass) {
							$(element).closest('.span6').removeClass("has-error");
						},
						rules: {
							//alamatkantor : {required: true, },
							primaryMSISDN: {
								required: false,
								//nomorRegex: true,
								//minlength: 6,
							},
							infogedung : { required: false, },
							noktp:{
								required: true,
								//minlength: 16,
							},
							nokk:{
								required: true,
								//minlength: 16,
							},
							imagektp:{
								required: true,
								accept: "image/jpg,image/jpeg,image/png,image/gif",
								filesize: 3145728,
							},
							imagepeg:{
								required: true,
								accept: "image/jpg,image/jpeg,image/png,image/gif",
								filesize: 3145728,
							},
							fullname: { required: true, },
							deliveryaddress: { required: true, },
							deliveryprovince: { required: true,},
							deliverycity: { required: true,},
							kodepos: {
								required: true,
								minlength: 5,
							},
							birthplace: {required: true, },
                            year : {validDate:true,},
							ibuname: {required: true, },
							phoneno: {required: true,minlength: 8, },
							emailref: { required: false,strictemail:'Please enter a valid email address.', },
						},
						messages: {
							primaryMSISDN: {required: "MSISDN required !",},
							imagektp : {required: "Please upload your KTP image !",
								accept:"Only files of type jpg, png, gif is allowed",
							},
							imagepeg : {required: "Please upload your NIP image !",
								accept:"Only files of type jpg, png, gif is allowed",
							},
							infogedung : {required: "Info Gedung required !",},
							nokk: {required: "No KK required !",},
							noktp: {required: "No KTP required !",},
							fullname : {required: "Your Name required !",},
							deliveryaddress: {required: "Address required !",},
							deliveryprovince : {required: "Your Province required !",},
							deliverycity : {required: "Your City required !",},
							kodepos: {required: "KodePos required !",},
							birthplace : {required: "Tempat Lahir required !",},
							ibuname: {required: "Name IBU required !",},
							phoneno: {required: "Phone required !",},
						}
					});
					

                    if (form.valid() === true && isCapil === true){
						if ($('#halaman1').is(":visible")){
							current_fs = $('#halaman1');
							next_fs = $('#halaman2');
							$("#pageNumber").html("halaman 2 dari 2");
						}
						//$("#pageNumber").html("halaman 2 dari 2");
						next_fs.show(); 
						current_fs.hide();
						$("html, body").animate({ scrollTop: ($('#scrollHere2').offset().top-500) }, 2000);
					}else{
						$("html, body").animate({ scrollTop: ($('.has-error').offset().top-300 ) }, 2000);
					}

                   }

                    // Store OfferList to Session
                    var storeMe = $(".package-list").html();
                    $.ajax({
                        type: "POST",url: "<?php echo base_url();?>registrasi/storeMe",
                        data : {storeMe: storeMe},success: function(data){console.log(data)},
                    });
				}); // END .nextz onclick
				
				$('.backz').click(function(){
					if($('#halaman2').is(":visible")){
						current_fs = $('#halaman2');
						next_fs = $('#halaman1');
						$("#pageNumber").html("halaman 1 dari 2");
						//$("html, body").animate({ scrollTop: ($('#halaman1').offset().top-500) }, "slow");
					}
					//$("#pageNumber").html("halaman 1 dari 2");
					next_fs.show(); 
					current_fs.hide();
					$("html, body").animate({ scrollTop: ($('#scrollHere1').offset().top-500) }, "slow");
				});
			});
		</script>

        <!-- JAVASCRIPT FOR PAGINATION ALAMAT -->
		<script type="text/javascript">  
         $(document).ready(function () {  
           var itemsOnPage = 3;  
           $('#paging').pagination({  
             items: $('#paagee > span').length,  
             itemsOnPage: itemsOnPage, 
             nextText: 'Selanjutnya',
             prevText: 'Sebelumnya',
             hrefTextPrefix: 'javascript:void(0);',
             hrefTextSuffix: 'javascript:void(0);',
             cssStyle: 'dark-theme',  
             onPageClick: function (pageNumber, event) {  
               var pageN = pageNumber != 0 ? (pageNumber - 1) : pageNumber;  
               var from = (pageN * itemsOnPage) + 1;  
               var to = (pageNumber * itemsOnPage);  
               //console.log('page :'+pageNumber+' from: ' + from + ' to :' + to);  
               $('#paagee > span').css({ 'display': 'none' });  
               for (var i = from; i <= to ; i++) {  
                 //console.log('loop :'+i);  
                 $('#paagee > span:eq(' + (i-1) + ')').css({ 'display': 'block' });  
               }  
             },  
             onInit: function () {  
               $('#paagee > span').css({ 'display': 'none' });  
               for (var i = 0; i <itemsOnPage; ++i) {  
                 $('#paagee > span:eq('+i+')').css({ 'display': 'block' });  
               }  
             }  
           });  
         });  
        </script>

        <!-- JAVASCRIPT FOR SELECT BOX GET MSISDN FROM API -->
		<script type="text/javascript">
		   $(document).ready(function(){
		    $('#carimsisdn').click(function(){
		      var wildNumber = $('#primaryMSISDN').val();
              var regionz = ($("input[name=alamatkantor]:checked").val()).split("|")[2];
              if(!$.isNumeric(wildNumber)) {
                $("#ketpilih").html('Please input only numeric values!').css({ 'color': 'red', 'font-size': '120%' });
                return false;
              } 

		      $(".contaRadio").remove();
              $("#currentNo").hide();
		      var $this = $('#carimsisdn');
		      $this.button('loading');
			    // Then whatever you actually want to do i.e. submit form
			    // After that has finished, reset the button state using
			    

		        $.ajax({
		        	type:'POST',
		        	data:{toserverFind: wildNumber,toserverFindz: regionz},
		        	url:'<?php echo base_url('registrasi/API_MSISDN_Get'); ?>',
		        	dataType: "json",
		        	success: function(result){
		        		/*$('#radioMSISDN > span').addClass('radioSelectItemCustom');*/
                        if(result == "NO MSISDN FOUND") 
                        {
                            $('<span class="contaRadio" style=padding-left:5px;>NO MSISDN FOUND</span>').hide().appendTo('#radioMSISDN').show('slow');
                            $this.button('reset');
                            $("hr").show();
                        } else 
                        {
			        	var $i =  1;
			        	for (var x = 0; x < Object.keys(result).length; x++) {
			        		$('<label class="contaRadio" style="display:block;">'+result[x]+
				        			'<input id="secondaryMSISDN' + ($i) + '" type="radio" name="secondaryMSISDN" value="'+result[x]+'">'+
				        			'<span class="checkmark"></span>'+
				        		'</label>').hide().appendTo('#radioMSISDN').show('slow');
				        	
				        	$i = $i + 1;
						//alert(result[x]);
						}
						$this.button('reset');
						$("hr").show();
						$("#ketpilih").html('Pilih nomor kartuHalo yang Anda inginkan.').css({ 'color': '', 'font-size': '' });
                        }
						//setTimeout(function() {$this.button('reset');}, 2000);
			        }
		   });
		  });
            $('#primaryMSISDN').keypress(function(e){
                if(e.which == 13){//Enter key pressed
                    $('#carimsisdn').click();//Trigger search button click event
                }
            });
		 });
		</script>

        <!-- JAVASCRIPT FOR PACKAGE TYPE TRY and ERROR 
		<script type="text/javascript">
		  $(".calendar :radio").hide().click(function(e){
            e.stopPropagation();
          });
          $(".calendar div").click(function(e){
            $(this).closest(".calendar").find("div").removeClass("selected");
            $(this).addClass("selected").find(":radio").click();
          });
	    </script>
        -->

        <!-- AJAX FOR SELECT BOX PROVINSI & KOTA -->
        <script type="text/javascript">
            $(document).ready(function(){
                $('#provinces').change(function(){
                    var id=$(this).val();
                    $.ajax({
                        url : "<?php echo base_url();?>registrasi/ambil_data",
                        type : "POST",
                        data : {id: id},
                        async : false,
                        dataType : 'json',
                        success: function(data){
                            var html = '<option value="">Kota</option>';
                            var i;
                            for(i=0; i<data.length; i++){
                                html += '<option value="'+data[i]+'">'+data[i]+'</option>';
                            }
                            $('#cities').html(html);
                            //$('#kodePos').val("data");
                             
                        }
                    });
                });
            });
        </script>

        <!-- AJAX FOR GET LIST OFFER FROM RADIO BUTTON CLICK -->
        <script type="text/javascript">
            $(document).ready(function(){
                $("#primaryMSISDN,#carimsisdn").prop('disabled', true);//$('#showMeLater').hide();

                $('input[name="alamatkantor"]').click(function(){
                    $('input[name="secondaryMSISDN"]').attr("checked", false);
                    //$('input[name="packagetype"]').attr("checked", false);
                    $("#primaryMSISDN,#carimsisdn").prop('disabled', false);
                    $("#currentNo,#currentPack,hr").hide();
                    $('.contaRadio,.D1').remove();
                    $('#ketpilih').html("Cari nomor yang mengandung angka cantik yang Anda ketikan");
                    $('#showMeLater').hide().fadeIn("normal").css({"font-family": "\'Titillium Web\',sans-serif","font-size": "13px"});
                    var theValue=$(this).val();
                    var accID = theValue.split('|')[0];

                    $.ajax({
                        url : "<?php echo base_url();?>registrasi/API_List_Package",
                        type : "POST",
                        data : {accID: accID},
                        dataType : 'json',
                        success: function(result){
                            //alert(accID);//alert(result.length);
                            console.log(result);
                            
                            var hasilHTML = '';
                            var counter=0,header,content,ender;
                            ////for(var w=0;w<result[0]['v1product_desc'].length;++w){console.log("a - "+w);}
                            jQuery.each(result, function(index, data) {
                                // do something with `item` (or `this` is also `item` if you like)
                                //console.log('indexKe-'+index);
                            
                            header=content=ender='';
                            var pro_id = data['v1product_id'];
                            var pro_name = data['v1product_name'];
                            var pro_price = data['v1price'].slice(0,-3);
                            var pro_desc = data['v1product_desc'];

                            header = '<label class="D1">'+
                                           //'<label class="contaRadio">'+
                                           '<input type="radio" name="packagetype" value="'+pro_id+'|'+pro_name+'">'+
                                           //'<span class="checkmark"></span></label>'+
                                           //'<input class="paketku" type="radio" name="packagetype" value="100">'+
                                           '<div class="D2"><h5>'+pro_name+'</h5></div>'+

                                           '<div class="numerical price medium" data-currency="Rp" data-decimal=".000" style="margin-top:10px;margin-bottom: 20px;">'+pro_price+'</div>'+

                                           '<div class="table-div">';

                            counter = data['v1product_desc'].length;

                            if(typeof(data['v1product_desc'][0]) === "undefined"){      // jika hanya ada 1 offer per <DATA>
                                var isUnit = (pro_desc['v1unit']=='null') ? pro_desc['v1name']:data['v1product_desc']['v1unit'];
                                content += '<div class="row row-0">'+
                                                '<div class="thead">'+
                                                  '<span>'+pro_desc['v1name']+'</span>'+
                                                '</div>'+
                                                 
                                                '<div class="tbody">'+
                                                  '<div class="numericcc">'+pro_desc['v1value']+
                                                  '<sup>'+isUnit+'</sup></div>'+
                                                '</div>'+
                                            '</div>';
                            }else{
                            for(var z=0;z<counter;++z){
                                var isUnit = (pro_desc[z]['v1unit']=='null') ? pro_desc[z]['v1name']:data['v1product_desc'][z]['v1unit'];
                                content += '<div class="row row-0">'+
                                                '<div class="thead">'+
                                                  '<span>'+pro_desc[z]['v1name']+'</span>'+
                                                '</div>'+
                                                 
                                                '<div class="tbody">'+
                                                  '<div class="numericcc">'+pro_desc[z]['v1value']+
                                                  '<sup>'+isUnit+'</sup></div>'+
                                                '</div>'+
                                            '</div>';
                            }}
                            ender ='</div></label>';

                            hasilHTML += header+content+ender;
                            }); //END JQuery each

                            $(hasilHTML).hide().appendTo('.package-list').fadeIn( "slow" ).css({"display": "inline-block"});
                            ////var hasilHTMLz = '<label class="D1"><input class="paketku" type="radio" name="packagetype" value="990"><div class="D2"><h5>HaloPal</h5></div><div class="numerical price medium" data-currency="Rp" data-decimal=".000" style="margin-top:10px;margin-bottom: 20px;">990</div><div class="table-div"><div class="row row-0"><div class="thead"><span>Internet</span></div><div class="tbody"><div class="numericcc">8<sup>GB</sup></div></div></div><div class="row row-0"><div class="thead"><span>Internet Email</span></div><div class="tbody"><div class="numericcc">600<sup>MB</sup></div></div></div><div class="row row-0"><div class="thead"><span>Call CUG</span></div><div class="tbody"><div class="numericcc">1000<sup>mins</sup></div></div></div><div class="row row-0"><div class="thead"><span>Call All Operator</span></div><div class="tbody"><div class="numericcc">60<sup>mins</sup></div></div></div><div class="row row-0"><div class="thead"><span>SMS CUG</span></div><div class="tbody"><div class="numericcc">1000<sup>SMS</sup></div></div></div><div class="row row-0"><div class="thead"><span>SMS All Operator</span></div><div class="tbody"><div class="numericcc">60<sup>SMS</sup></div></div></div></div></label>';
                            ////var hasilHTMLzz = '<label class="D1"><input class="paketku" type="radio" name="packagetype" value="390"><div class="D2"><h5>HaloPal</h5></div><div class="numerical price medium" data-currency="Rp" data-decimal=".000" style="margin-top:10px;margin-bottom: 20px;">390</div><div class="table-div"><div class="row row-0"><div class="thead"><span>Internet</span></div><div class="tbody"><div class="numericcc">8<sup>GB</sup></div></div></div><div class="row row-0"><div class="thead"><span>Internet Email</span></div><div class="tbody"><div class="numericcc">600<sup>MB</sup></div></div></div><div class="row row-0"><div class="thead"><span>Call CUG</span></div><div class="tbody"><div class="numericcc">1000<sup>mins</sup></div></div></div><div class="row row-0"><div class="thead"><span>Call All Operator</span></div><div class="tbody"><div class="numericcc">60<sup>mins</sup></div></div></div><div class="row row-0"><div class="thead"><span>SMS CUG</span></div><div class="tbody"><div class="numericcc">1000<sup>SMS</sup></div></div></div><div class="row row-0"><div class="thead"><span>SMS All Operator</span></div><div class="tbody"><div class="numericcc">60<sup>SMS</sup></div></div></div></div></label>';
                            ////$(hasilHTMLz).hide().appendTo('.package-list').fadeIn( "slow" ).css('display','inline-block');
                            ////$(hasilHTMLzz).hide().appendTo('.package-list').fadeIn( "slow" ).css('display','inline-block');
                        }   //END success
                    });
                });
            });
        </script>

        <!-- JAVASCRIPT FOR PACKAGE TYPE 
        <script type="text/javascript">
          //$(".paketku").prop("checked", true);
          //if($('.paketku').attr('checked', 'checked')) { $(".package-list > .D1").addClass("selected"); }

          $(".package-list :radio").hide().click(function(e){
            e.stopPropagation();
          });
          $(".package-list > .D1").click(function(e){
            $(this).closest(".package-list").find(".D1").removeClass("selected");
            $(this).addClass("selected").find(":radio").click();
          });
        </script>-->

        <!-- <script type="text/javascript">
            $(document).ready(function () {
                $('.package-list').on("click", ".D1", function (e) {
                    //$('.D1').css("background-color","red");
                    //alert('ell');
                    e.stopPropagation();
                });
                $(".package-list>.D1").click(function(e){
                    $(this).closest(".package-list").find(".D1").removeClass("selected");
                    $(this).addClass("selected").find(":radio").click();
                });
            });
        </script> -->

        <script type="text/javascript">
            $(document).ready(function(){
                
                $('.package-list').on('change','.D1', function(){
                
                    //alert('asd');
                    var $this = $(this);
                    $this.closest('.package-list').find('label.highlight').removeClass('highlight');
                    $this.closest('.D1').addClass('highlight');
                });
            });
        </script>

        <!-- JS FOR DATATABLE ALAMAT KANTOR -->
        <script type="text/javascript">
            $(document).ready(function(){
              //$('#demo').html( '<table cellpadding="0" style="width:100%" cellspacing="0" border="0" class="display" id="example"></table>' );
              var currAlamat = <?php echo json_encode($alamatkantor) ?>;
              var curraddrVal = <?php echo json_encode($offiaddrVal) ?>;

              var table = $('#example').DataTable({
              "bLengthChange": false,
              "bJQueryUI": true,
              "info":false,
              "scrollX": true,
              "ordering": false,
              "lengthMenu": [ [5,10, 25], [5,10, 25] ],
              "sPaginationType": "full_numbers",

              // save state of DataTable
              "bStateSave": true,
              "fnStateSave": function (oSettings, oData) {localStorage.setItem('offersDataTables', JSON.stringify(oData));},
              "fnStateLoad": function (oSettings) {return JSON.parse(localStorage.getItem('offersDataTables'));},

              // re-Draw Table when table change , prop "checked"->"false"
              "fnDrawCallback": function(oSettings) {console.log("RESETCHECKED");$("input[name=alamatkantor]").parent("span").removeClass("jcf-checked")}
              });

              //var rows = table.rows(0).data();
              //console.log(rows[0][1]);

              // loop through every rows to checked the last
              table.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
                var d = this.data();
                if(d[1]==currAlamat){
                  $('input[type="radio"][value="'+curraddrVal+'"]').parent("span").removeClass("jcf-unchecked").addClass("jcf-checked");
                  return false;
                }
              });

            });
        </script>