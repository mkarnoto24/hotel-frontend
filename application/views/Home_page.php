<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('template/header_css.php');?>
</head>
<body onload="load_rooms()">
    <div id="wrapper">
        <header>
            <!-- ===========UNTUK MELOAD ICON MEDSOS DAN MENU BAR=========== -->
            <?php
                $this->load->view('template/top_menu');
            ?>
            
        </header>
        <section id="featured">
                  <!-- start slider -->
            <div id="da-slider" class="da-slider">
                <div class="da-slide">
                    <h2>Easy management</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the
                        blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large
                        language ocean.</p>
                    <a href="#" class="btn btn-theme btn-large da-link">Read more</a>
                    <div class="da-img"><img src="<?php echo base_url('assets/img/slides/parallax/1.png')?>" alt="" /></div>
                </div>
                <div class="da-slide">
                    <h2>Embed your video</h2>
                    <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a
                        paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                    <a href="#" class="btn btn-primary btn-large da-link">Read more</a>
                    <div class="da-img">
                        <div class="video-container">
                            <iframe src="http://player.vimeo.com/video/30585464?title=0&amp;byline=0"> </iframe>
                        </div>
                    </div>
                </div>
                <div class="da-slide">
                    <h2>Great for any websites</h2>
                    <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life
                        One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far
                        World of Grammar.</p>
                    <a href="#" class="btn btn-success btn-large da-link">Read more</a>
                    <div class="da-img"><img src="<?php echo base_url('assets/img/slides/parallax/2.png');?>" alt="" /></div>
                </div>
                <nav class="da-arrows">
                    <span class="da-arrows-prev"></span>
                    <span class="da-arrows-next"></span>
                </nav>
            </div>
            <!-- end slider -->

        </section>
        <section id="content">
            <div class="container">
                <div class="span12">
                    <div class="row" id="list_rooms">
                        
                        
                    </div>
                </div>
            </div>
            <div class="modal fade" id="exampleModal" 
                 tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h5 class="modal-title" id="exampleModalLabel">Detail Hotel</h5>
                                
                            </div>
                            <div class="modal-body">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <footer>
            <!-- ===========UNTUK MELOAD FOOTER=========== -->
            <?php $this->load->view('template/footer');?>
        </footer>
    </div>
    <?php 
        $this->load->view('template/footer_js');
    ?> <!--- ===UNTUK MELOAD JAVASCRIPT=== -->
    <script>
        function load_rooms(){
            $.ajax({
                url:'http://localhost:7000/api/v1/rooms',
                type:'GET',
                dataType:'JSON',
                success: function(results){
                    if(results.status === "ok"){
                        let room = results.data;
                        $.each(room, function(i,data){
                            $("#list_rooms").append(
                                    `<div class="span4">
                                        <div class="card" style="width: 18rem; border:1px solid gray; padding: 10px;border-radius: 5px">
                                            <img class="card-img-top"
                                                 src="${data.img}" alt="hotel-image">
                                            <div class="card-body">
                                                <h5 class="card-title" style="margin-top:20px">${data.name}</h5>
                                                <div>
                                                    <p class="card-title" style="margin-top:20px">
                                                        <span style="float:left">Rp. ${data.price}</span>
                                                    </p>
                                                </div><br>
                                              <button class="btn btn-primary pesan" 
                                                 data-toggle="modal" data-target="#exampleModal" data-id="${data.id}"
                                                 style="margin-top: 20px">Pesan</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    `
                            );
                        });
                    }
                }
            });
        }
        
        $("#list_rooms").on('click','.pesan',function(){
            let id = $(this).data('id');
//            alert(id);
            $.ajax({
                url:`http://localhost:7000/api/v1/room/${id}`,
                type:'GET',
                dataType:'JSON',
                success:function(result){
                    // console.log(result[0])
                    let data = result.data[0]
                    console.log(data)
                    if(result.status==="ok"){
                        $('.modal-body').html(
                         `<div class="container-fluid">
                            <div class="row">
                                <div class="span5">
                                    <img src="${data.img}" alt="hotel-image" style="margin: auto">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Tipe Kamar</td>
                                            <td>${data.name}</td>
                                        <tr>
                                        <tr>
                                            <td>Tipe Kamar</td>
                                            <td>${data.price}</td>
                                        <tr>
                                        <tr>
                                            <td>Jumlah Kamar</td>
                                            <td>
                                                <select>
                                                    <option>Single</opion>
                                                    <option>Deluxe</opion>
                                                    <option>Double</opion>
                                                </select>
                                            </td>
                                        <tr>
                                        <tr>
                                            <td>Nama Lengkap</td>
                                            <td>
                                                <input type="text" placeholder="Nama Lengkap Anda" />
                                            </td>
                                        <tr>
                                        <tr>
                                            <td>No. Hp</td>
                                            <td>
                                                <input type="text" placeholder="No. Hp" />
                                            </td>
                                        <tr>
                                        <tr>
                                            <td>Tanggal Check In</td>
                                            <td>
                                                <input type="date" />
                                            </td>
                                        <tr>
                                        <tr>
                                            <td>Tanggal Check Out</td>
                                            <td>
                                                <input type="date" onchange="lama_inap()"/>
                                            </td>
                                        <tr>
                                        <tr>
                                            <td>Lama Menginap</td>
                                            <td>
                                                <input disabled type="text" value=" hari"/>
                                            </td>
                                        <tr>
                                        <tr>
                                            <td colspan="2">
                                                <button type="button" class="btn btn-primary">Save</button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                          </div>`
                        );
                    }
                    else {
                        alert("error");
                    }
                    
                }
            });
        });

        function lama_inap(){
            alert("test");
        }
    </script>
    
</body>