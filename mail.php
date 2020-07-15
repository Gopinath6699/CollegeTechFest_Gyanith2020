<html>

<body>
<?php


try{
    
    $subject="Greetings from Gyanith";
    $content="Dear Participant, 
Greetings from Team Gyanith
Thank you for showing your interest in Gyanith’20. We are pleased to have you celebrate technology with us at one of South India’s biggest technical festivals.
Gyanith offers various Technical and Non-technical workshops like 

    1. Computer vision using OpenCV
    2. Natural Language Processing 
    3. Angular Web App Development 
    4. Data Science and Python 
    5. Ethical Hacking 
    6. Hybrid and Electric Vehicles 
    7. Humanoid Robots 
    8. Data Acquisition using LabView 
    9. Quadcopter designing 
    10. Embedded Robotics and IOT 
    11. CATIA V5
    12. Mercedes Benz Engine Analysis 
    13. STAAD Pro 
    14. Aperture 
    15. Business Model Canvas
    
Apart from Technical workshops, Gyanith consists of various technical and non-technical events like Burnout, Robo soccer, Debug C bug, Project expo, Science expo (for school students), LineX, Shake It, Brick it, Gyanith’s Flagship event Avishkar, Carro Quiz, Gaming events, Face Painting, Pixelcraft, Tattoo Making, and Novo Initio Quiz. 
Enjoy the Proshows by TWIN JUGGLERS, Entrepreneurial talk by Divanshu Kumar, and Insane Aashish, the Illusionist and use your coding skills and brainstorm ideas in the Hackathon by 3G IRPS. 
Join us from 4th to 7th March, 2020 for our energetic and informative techno carnival.

Note:
    • Pre-registrations from workshops and events have begun on the official website of Gyanith. All company based workshops require pre-registrations. 
    • Accommodation will be provided on first come, first serve basis. 
    
For more details, log on to www.gyanith.org 
or download our app from playstore
https://play.google.com/store/apps/details?id=com.barebrains.gyanith20";
  
    
    
    $con=new PDO("mysql:host=localhost;port=3306;dbname=gyanimzj_gy20","gyanimzj_user","Gyanith@20");
    
    $q="select email from users where email is not NULL";
    $r=$con->query($q);

    $a=$r->fetchAll(PDO::FETCH_ASSOC);
    //print_r($a);
    $h= "Content-type:text/html;charset=UTF-8";
    foreach($a as $k=>$v){
        //echo $v['email'];
        mail($v['email'],$subject,$content,$h);
      
    }
    
    
    //mail("hviknesh07@gmail.com",$subject,$content,$h);
    echo "Mail sent successfully to all Gyanith users.";
    
    
}catch(Exception $e){
    echo "Unable to connect to db";
}

?>
</body></html>