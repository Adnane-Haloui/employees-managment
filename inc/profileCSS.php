<style>
  @import url(https://fonts.googleapis.com/css?family=Oswald:400,300);
  @import url(https://fonts.googleapis.com/css?family=Open+Sans);
  * {
      margin: 0;
    padding: 0;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
  }

  body {
    background: #2d2c41;
    font-family: 'Open Sans', Arial, Helvetica, Sans-serif, Verdana, Tahoma;
  }
  .iamgurdeep-pic {
      position: relative;
  }
  .username {
      bottom: 0;
      color: #ffffff;
      padding: 30px 15px 4px;
      position: absolute;
      width: 100%;
      text-shadow: 1px 1px 2px #000000;
      
  background: -moz-linear-gradient(top, rgba(0,0,0,0) 0%, #2d2c41 100%); /* FF3.6-15 */
  background: -webkit-linear-gradient(top, rgba(0,0,0,0) 0%, #2d2c41 100%); /* Chrome10-25,Safari5.1-6 */
  background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, #2d2c41 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00000000', endColorstr='#a64d4d4d',GradientType=0 ); /* IE6-9 */
  }
  .iamgurdeeposahan {
      border-radius: 4px 4px 0 0;
  }
  .username > h2 {
      font-family: oswald;
      font-size: 27px;
      font-weight: lighter;
      margin: 31px 0 4px;
      position: relative;
      text-shadow: 1px 1px 2px #000000;
      text-transform: uppercase;
  }
  .username > h2 small {
      color: #ffffff;
      font-family: open sans;
      font-size: 13px;
      font-weight: 400;
      position: relative;
  }
  .username .fa{
      color: #ffffff;
      font-size: 14px;
      margin: 0 0 0 4px;
      position: static;
  }


  .tags {
      background: rgba(255, 255, 255, 0.1) none repeat scroll 0 0;
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 2px;
      display: inline-block;
      font-size: 13px;
      margin: 4px 0 0;
      padding: 2px 5px;
       -webkit-transition: all 0.4s ease;
      -o-transition: all 0.4s ease;
      transition: all 0.4s ease;
  }
  .tags:hover {
      background: rgba(255, 255, 255, 0.3) none repeat scroll 0 0;
      border: 1px solid rgba(255, 255, 255, 0.5);
      border-radius: 2px;
      display: inline-block;
      font-size: 13px;
      margin: 4px 0 0;
      padding: 2px 5px;
  }

  .submenu .iamgurdeeposahan {
      background: rgba(255, 255, 255, 0.1) none repeat scroll 0 0 !important;
      border-radius: 50%;
      height: 60px;
      padding: 2px;
      width: 60px;
  }
  .photosgurdeep > a {
      background: #ffffff none repeat scroll 0 0;
      border-radius: 50%;
      display: inline-block !important;
      padding: 0 !important;
  }
  .view-all {
      background: rgba(255, 255, 255, 0.1) none repeat scroll 0 0 !important;
      border: 1px solid;
      float: right;
      font-family: oswald;
      font-size: 26px;
      height: 60px;
      line-height: 61px;
      text-align: center;
      width: 60px;
  }
  .photosgurdeep {
      padding: 10px 9px 4px 35px;
  }
  ul {
    list-style-type: none;
  }

  a {
    color: #b63b4d;
    text-decoration: none;
  }

  /** =======================
   * Contenedor Principal
   ===========================*/
  h1 {
    color: #FFF;
    font-size: 24px;
    font-weight: 400;
    text-align: center;
    margin-top: 40px;
   }

  h1 a {
    color: #c12c42;
    font-size: 16px;
   }

   .accordion {
    width: 100%;
    max-width: 360px;
    margin: 30px auto 20px;
    background: #FFF;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
   }

  .accordion .link {
    cursor: pointer;
    display: block;
    padding: 15px 15px 15px 42px;
    color: #4D4D4D;
    font-size: 14px;
    font-weight: 700;
    border-bottom: 1px solid #CCC;
    position: relative;
    -webkit-transition: all 0.4s ease;
    -o-transition: all 0.4s ease;
    transition: all 0.4s ease;
  }

  .accordion li:last-child .link {
    border-bottom: 0;
  }

  .accordion li i {
    position: absolute;
    top: 16px;
    left: 12px;
    font-size: 18px;
    color: #595959;
    -webkit-transition: all 0.4s ease;
    -o-transition: all 0.4s ease;
    transition: all 0.4s ease;
  }

  .accordion li i.fa-chevron-down {
    right: 12px;
    left: auto;
    font-size: 16px;
  }

  .accordion li.open .link {
    color: #b63b4d;
  }

  .accordion li.open i {
    color: #b63b4d;
  }
  .accordion li.open i.fa-chevron-down {
    -webkit-transform: rotate(180deg);
    -ms-transform: rotate(180deg);
    -o-transform: rotate(180deg);
    transform: rotate(180deg);
  }

  .accordion li.default .submenu {display: block;}
  /**
   * Submenu
   -----------------------------*/
   .submenu {
    display: none;
    background: #444359;
    font-size: 14px;
   }

   .submenu li {
    border-bottom: 1px solid #4b4a5e;
   }

   .submenu a {
    display: block;
    text-decoration: none;
    color: #d9d9d9;
    padding: 12px;
    padding-left: 42px;
    -webkit-transition: all 0.25s ease;
    -o-transition: all 0.25s ease;
    transition: all 0.25s ease;
   }

   .submenu a:hover {
    background: #b63b4d;
    color: #FFF;
   }
</style>