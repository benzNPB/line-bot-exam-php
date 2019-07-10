<?php
case "t_c":
    // กำหนด action 4 ปุ่ม 4 ประเภท
    $actionBuilder = array(
        new MessageTemplateActionBuilder(
            'Message Template',// ข้อความแสดงในปุ่ม
            'This is Text' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
        ),
        new UriTemplateActionBuilder(
            'Uri Template', // ข้อความแสดงในปุ่ม
            'https://www.ninenik.com'
        ),
        new PostbackTemplateActionBuilder(
            'Postback', // ข้อความแสดงในปุ่ม
            http_build_query(array(
                'action'=>'buy',
 
                'item'=>100
            )), // ข้อมูลที่จะส่งไปใน webhook ผ่าน postback event
            'Postback Text'  // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
        ),      
    );
    $replyData = new TemplateMessageBuilder('Carousel',
        new CarouselTemplateBuilder(
            array(
                new CarouselColumnTemplateBuilder(
                    'Title Carousel',
                    'Description Carousel',
                    'https://www.mywebsite.com/imgsrc/photos/f/sampleimage/700',
                    $actionBuilder
                ),
                new CarouselColumnTemplateBuilder(
                    'Title Carousel',
                    'Description Carousel',
                    'https://www.mywebsite.com/imgsrc/photos/f/sampleimage/700',
                    $actionBuilder
                ),
                new CarouselColumnTemplateBuilder(
                    'Title Carousel',
                    'Description Carousel',
                    'https://www.mywebsite.com/imgsrc/photos/f/sampleimage/700',
                    $actionBuilder
                ),                                          
            )
        )
    );
    break;  
?>
