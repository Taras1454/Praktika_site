<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';


</script>

<template>
<header>
    <img id=main_icon src="/src/assets/seria_a_icon.jfif" type="icon">
    <h1>
      Сайти клубів
    </h1>

    <a href="https://www.inter.it/en" target="_blank">
        <img class="icons" src="/src/clubs/inter.png" type="icon">
    </a>
    <a href="https://www.atalanta.it/" target="_blank">
        <img class="icons" src="/src/clubs/atalanta.png" type="icon">
    </a>
    <a href="https://www.asroma.com/en" target="_blank">
        <img class="icons" src="/src/clubs/roma.png" type="icon">
    </a>
    <a href="https://www.acffiorentina.com/en" target="_blank">
        <img class="icons" src="/src/clubs/fio.png" type="icon">
    </a>
    <a href="https://www.acmilan.com/en" target="_blank">
        <img class="icons" src="/src/clubs/milan.png" type="icon">
    </a>
    <a href="https://sscnapoli.it/en/" target="_blank">
        <img class="icons" src="/src/clubs/napoli.png" type="icon">
    </a>
    <a href="https://www.juventus.com/en/" target="_blank">
        <img class="icons" src="/src/clubs/juventus.png" type="icon">
    </a>
    <a href="https://www.sslazio.it/en" target="_blank">
        <img class="icons" src="/src/clubs/lazio.png" type="icon">
    </a>
    <a href="https://www.bolognafc.it/en/home/" target="_blank">
        <img class="icons" src="/src/clubs/bologna.png" type="icon">
    </a>
    <a href="https://cagliaricalcio.com/en/" target="_blank">
        <img class="icons" src="/src/clubs/cagliari.png" type="icon">
    </a>
    <a href="https://empolifc.com/" target="_blank">
        <img class="icons" src="/src/clubs/empoli.png" type="icon">
    </a>
    <a href="https://www.frosinonecalcio.com/" target="_blank">
        <img class="icons" src="/src/clubs/froz.png" type="icon">
    </a>
    <a href="https://www.uslecce.it/" target="_blank">
        <img class="icons" src="/src/clubs/lecce.png" type="icon">
    </a>
    <a href="https://genoacfc.it/" target="_blank">
        <img class="icons" src="/src/clubs/genoa.png" type="icon">
    </a>
    <a href="https://www.acmonza.com/en/" target="_blank">
        <img class="icons" src="/src/clubs/monza.png" type="icon">
    </a>
    <a href="https://salernitana.it/" target="_blank">
        <img class="icons" src="/src/clubs/saler.png" type="icon">
    </a>
    <a href="https://www.sassuolocalcio.it/en/" target="_blank">
        <img class="icons" src="/src/clubs/sasuolo.png" type="icon">
    </a>
    <a href="https://www.torinofc.it/en" target="_blank">
        <img class="icons" src="/src/clubs/torino.png" type="icon">
    </a>
    <a href="https://www.udinese.it/" target="_blank">
        <img class="icons" src="/src/clubs/udi.png" type="icon">
    </a>
    <a href="https://www.hellasverona.it/en" target="_blank">
        <img class="icons" src="/src/clubs/verona.png" type="icon">
    </a>
</header>

</template>

<style>
        #main_icon{
          height:47px;
          width:38px;
          top:64px;
          position:absolute;
          right:1043px;
        }
        h1{
          position: absolute;
          
          font-size:14px;
          left:275px;
          nav-down:5px;
        }
        .icons{
            position: relative;
            left:10%;
            height: 25px;
            transition: transform 0.3s ease, height 0.3s ease;
            margin:3px;
        }
        .icons:hover{
            height: 30px;
            transform: scale(1.2);
            

        }

      
</style>