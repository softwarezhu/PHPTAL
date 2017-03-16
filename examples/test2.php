<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 2016/3/30
 * Time: 16:36
 */
require __DIR__ . '/../vendor/autoload.php';

require '../classes/PHPTAL.php';

function deleteChildren(DOMNode $node) {
    while (isset($node->firstChild)) {
        $node->removeChild($node->firstChild);
    }
}

/**
 * @param DOMNode $element
 */
function parseElement(DOMNode $element)
{
    // 查找变量，并增加scope
    $context = '';
    if ($element->hasChildNodes()) {
        for ($i = 0; $i < $element->childNodes->length; $i++) {
            $childNode = $element->childNodes->item($i);

            parseElement($childNode);
        }
    }

    if ($element->hasAttributes()) {
        for ($i = 0; $i < $element->attributes->length;) {
            /**
             * @param DomAttr
             */
            $attribute = &$element->attributes->item($i);
            if ($attribute->name == 'tal:content') {
                $b = $element->removeAttribute($attribute->name);
                $value = $attribute->value;
                deleteChildren($element);

                echo $attribute->name . ' ' . $b . PHP_EOL;

            } else if ($attribute->name == 'tal:attributes') {
                $b = $element->removeAttribute($attribute->name);
                echo $attribute->name . ' ' . $b . PHP_EOL;
            } else if ($attribute->name == 'tal:condition') {
                $b = $element->removeAttribute($attribute->name);
                echo $attribute->name . ' ' . $b . PHP_EOL;
            } else if ($attribute->name == 'tal:repeat') {
                $b = $element->removeAttribute($attribute->name);
                echo $attribute->name . ' ' . $b . PHP_EOL;

            } else if ($attribute->name == 'tal:define') {
                $b = $element->removeAttribute($attribute->name);
                echo $attribute->name . ' ' . $b . PHP_EOL;

            } else if ($attribute->name == 'tal:replace') {
                $b = $element->removeAttribute($attribute->name);
                echo $attribute->name . ' ' . $b . PHP_EOL;

            } else {
                $i++;
            }
        }

    }


    // 结束scope
}

$xml = new DOMDocument();
$xml->formatOutput = true;

// Load the url's contents into the DOM
@$xml->loadHTMLFile('data/preview.html');

parseElement($xml);

$xml->saveHTMLFile('result.html');


class Parser
{
    public $xml;

    public $lines = [];

    public function __construct($file)
    {
        $xml = new DOMDocument();
        @$xml->loadHTMLFile($file);

        $this->xml = $xml;
    }

    public function execute()
    {
        $this->parseElement($this->xml);
    }


    /**
     * @param DOMNode $element
     */
    function parseElement(DOMNode $element)
    {
        // 查找变量，并增加scope
        $context = '';
//        if ($element->hasChildNodes()) {
//            for ($i = 0; $i < $element->childNodes->length; $i++) {
//                $childNode = $element->childNodes->item($i);
//
//                parseElement($childNode);
//            }
//        }

        if ($element->hasAttributes()) {
            for ($i = 0; $i < $element->attributes->length;) {
                /**
                 * @param DomAttr
                 */
                $attribute = &$element->attributes->item($i);
                if ($attribute->name == 'tal:content') {
                    $b = $element->removeAttribute($attribute->name);
                    $value = $attribute->value;
                    deleteChildren($element);

                    echo $attribute->name . ' ' . $b . PHP_EOL;

                } else if ($attribute->name == 'tal:attributes') {
                    $b = $element->removeAttribute($attribute->name);
                    echo $attribute->name . ' ' . $b . PHP_EOL;
                } else if ($attribute->name == 'tal:condition') {
                    $b = $element->removeAttribute($attribute->name);
                    echo $attribute->name . ' ' . $b . PHP_EOL;
                } else if ($attribute->name == 'tal:repeat') {
                    $b = $element->removeAttribute($attribute->name);
                    echo $attribute->name . ' ' . $b . PHP_EOL;

                } else if ($attribute->name == 'tal:define') {
                    $b = $element->removeAttribute($attribute->name);
                    echo $attribute->name . ' ' . $b . PHP_EOL;

                } else if ($attribute->name == 'tal:replace') {
                    $b = $element->removeAttribute($attribute->name);
                    echo $attribute->name . ' ' . $b . PHP_EOL;

                } else {
                    $i++;
                }
            }

        }


        // 结束scope
    }
}

/*
$prevReporting = error_reporting(E_ERROR);
$template = new PHPTAL();
$template->setSource(file_get_contents('data/preview.html'));


$data_str = <<<EO
{"block10":{},"block1":{},"block11":{},"block2":{},"block12":{},"block3":{},"block4":{},"block5":{"products":[{"title":"Men's Watch World Map Case Quartz Denim Band Simple Dress Wacth Casual Watch","image_alt":null,"price":"HKD $52.05","image_src":"http://litbimg4.rightinthebox.com/images/500x500/201607/omdvht1467775685189.jpg","link":"http://localhost:8080/men-s-mapping-case-denim-band-dress-wacth_p5067881.html","state":"0.00% Off","btn_style":"2"},{"title":"CURREN®Men‘s Watch Dress Watch Calendar Casual Watch Steel Band Black Cool Watch Unique Watch Fashion Watch","image_alt":null,"price":"HKD $112.88","image_src":"http://litbimg2.rightinthebox.com/images/500x500/201608/bqg1470392948587.jpg","link":"http://localhost:8080/men-s-round-dial-alloy-band-quartz-analog-wrist-watch_p1091056.html","state":"52.00% Off","btn_style":"2"},{"title":"YAZOLE® Brand Men‘s Dress Watch Quartz Casual Watch Leather Band Black / Brown Fashion Wrist Watch","image_alt":null,"price":"HKD $78.12","image_src":"http://litbimg3.rightinthebox.com/images/500x500/201607/oyytsb1469764302198.jpg","link":"http://localhost:8080/men-s-fashion-quartz-night-light-dress-watch-assorted-colors_p5082867.html","state":"26.00% Off","btn_style":"2"},{"title":"V6® Men‘s Watch Dress Watch Simple Style Bronze Round Dial Cool Watch Unique Watch Fashion Watch","image_alt":null,"price":"HKD $43.36","image_src":"http://litbimg2.rightinthebox.com/images/500x500/201508/wcgs1440483896235.jpg","link":"http://localhost:8080/men-s-simple-style-bronze-round-dial-pu-band-quartz-wrist-watch-assorted-colors_p1764961.html","state":"29.00% Off","btn_style":"2"},{"title":"CHENXI® Men's Fashion Watch Golden Stainless Steel Imitation Diamond Quartz Wrist Watch Brand Cool Watch Dress Watch Unique Watch","image_alt":null,"price":"HKD $121.57","image_src":"http://litbimg8.rightinthebox.com/images/500x500/201509/tzliin1441875817645.jpg","link":"http://localhost:8080/chenxi-golden-fashion-men-watch-stainless-steel-quartz-wrist-watch_p4279582.html","state":"27.00% Off","btn_style":"2"},{"title":"Men Wide Belt,Work / Casual Leather All Seasons","image_alt":null,"price":"HKD $147.64","image_src":"http://litbimg5.rightinthebox.com/images/500x500/201406/tevugn1403083549911.jpg","link":"http://localhost:8080/men-s-fashionable-dress-leather-belt_p1510466.html","state":"0.00% Off","btn_style":"2"},{"title":"Men's Dresses , Cotton Casual Voboom","image_alt":null,"price":"HKD $25.98","image_src":"http://litbimg5.rightinthebox.com/images/500x500/201408/otxhil1408517808826.jpg","link":"http://localhost:8080/voboom-men-s-long-sleeve-shirt_p1827390.html","state":"77.00% Off","btn_style":"2"}]},"block6":{"products":[{"title":"Women's Bow Neck Stripes Print Long Sleeves T-shirt","image_alt":null,"price":"HKD $86.81","image_src":"http://litbimg7.rightinthebox.com/images/500x500/201601/vdur1452136769107.jpg","link":"http://localhost:8080/women-s-stand-collar-long-sleeves-t-shirt_p824025.html","state":"0.00% Off","btn_style":"2"},{"title":"Men‘s Gold Round Dial Alloy Band Quartz Analog Wrist Watch Cool Watch Unique Watch Fashion Watch","image_alt":null,"price":"HKD $104.19","image_src":"http://litbimg2.rightinthebox.com/images/500x500/201504/jsxb1429691921405.jpg","link":"http://localhost:8080/men-s-gold-round-dial-alloy-band-quartz-analog-wrist-watch_p905259.html","state":"0.00% Off","btn_style":"2"},{"title":"WINNER® Men‘s  Automatic Mechanical Date Black Leather Band Wrist Watch Cool Watch Unique Watch Fashion Watch","image_alt":null,"price":"HKD $173.71","image_src":"http://litbimg4.rightinthebox.com/images/500x500/201603/njmuuc1458695273685.jpg","link":"http://localhost:8080/men-s-automatic-mechanical-date-black-leather-band-wrist-watch_p4861162.html","state":"24.00% Off","btn_style":"2"},{"title":"YAZOLE® Brand Men‘s Dress Watch Quartz Casual Watch Leather Band Black / Brown Fashion Wrist Watch","image_alt":null,"price":"HKD $78.12","image_src":"http://litbimg3.rightinthebox.com/images/500x500/201607/oyytsb1469764302198.jpg","link":"http://localhost:8080/men-s-fashion-quartz-night-light-dress-watch-assorted-colors_p5082867.html","state":"26.00% Off","btn_style":"2"},{"title":"SANDA® Men‘s Fashion Sport Analog Digital Double Time Rubber Band Waterproof Watch Fashion Wrist Watch Cool Watch","image_alt":null,"price":"HKD $130.26","image_src":"http://litbimg1.rightinthebox.com/images/500x500/201608/ktle1470795378630.jpg","link":"http://localhost:8080/men-s-fashion-sport-analog-digital-double-time-rubber-band-waterproof-watch_p5117253.html","state":"26.00% Off","btn_style":"2"},{"title":"Bluetooth smart watch U8 Wrist Watch U smartWatch for Samsung S4/Note2/3 HTC LG Xiaomi Android Apple Phone Smartphones","image_alt":null,"price":"HKD $130.26","image_src":"http://litbimg7.rightinthebox.com/images/500x500/201509/zbbutr1442540488297.jpg","link":"http://localhost:8080/bluetooth-smart-watch-u8-wrist-watch-u-smartwatch-for-samsung-s4-note2-3-htc-lg-xiaomi-android-apple-phone-smartphones_p4321864.html","state":"51.00% Off","btn_style":"2"},{"title":"V3 smart wristband","image_alt":null,"price":"HKD $243.23","image_src":"http://litbimg7.rightinthebox.com/images/500x500/201608/mwniby1470649746340.jpg","link":"http://localhost:8080/v3-smart-wristband_p5157982.html","state":"25.00% Off","btn_style":"2"},{"title":"WINNER® Men‘s 6 Pointers Auto Mechanical Stainless Steel Wrist Watch Cool Watch Unique Watch Fashion Watch","image_alt":null,"price":"HKD $234.54","image_src":"http://litbimg8.rightinthebox.com/images/500x500/201501/momx1421752220103.jpg","link":"http://localhost:8080/men-s-6-pointers-auto-mechanical-stainless-steel-wrist-watch_p4861161.html","state":"26.00% Off","btn_style":"2"}]},"block7":{"products":[{"title":"ASJ Luxury Famous Sports Waterproof Noctilucent Stopwatch Wristwatches Men‘s Watch Dual Time Outdoor Electronics Fashion Watch","image_alt":null,"price":"HKD $191.09","image_src":"http://litbimg8.rightinthebox.com/images/500x500/201607/xdtltq1467681786755.jpg","link":"http://localhost:8080/asj-luxury-famous-sports-waterproof-wristwatches-men-s-watch-dual-time-outdoor-electronics_p5065277.html","state":"25.00% Off","btn_style":"2"},{"title":"Stylish Women's Dress, V-neck Long Sleeve Loose-fitting ","image_alt":null,"price":"HKD $78.12","image_src":"http://litbimg3.rightinthebox.com/images/640x853/201601/dnbs1451832614519.jpg","link":"http://localhost:8080/queen-women-s-chiffon-v-neck-a-line-long-sleeve-dresses_p1636087.html","state":"0.00% Off","btn_style":"2"},{"title":"Men‘s Military Fashion Sport Watch Japanese Quartz Digital LED/Calendar/Chronograph/Water Resistant/Alarm (Assorted Colors) Cool Watch Unique Watch","image_alt":null,"price":"HKD $95.50","image_src":"http://litbimg6.rightinthebox.com/images/500x500/201504/pattrr1428995577837.jpg","link":"http://localhost:8080/men-s-military-sport-watch-japanese-quartz-digital-led-calendar-chronograph-water-resistant-alarm-assorted-colors_p3041340.html","state":"27.00% Off","btn_style":"2"},{"title":"Bluetooth3.0 camber surface Smart Watch Pedometer Sleep Monitor Sync Call Message for Android Phone& iphone Fashion Watch","image_alt":null,"price":"HKD $217.16","image_src":"http://litbimg7.rightinthebox.com/images/500x500/201506/bdcesq1434527008538.jpg","link":"http://localhost:8080/bluetooth3-0-smart-watch-pedometer-sleep-monitor-sync-call-message-for-android-phone_p3701533.html","state":"31.00% Off","btn_style":"2"},{"title":"13-Piece Watch Repair Tool Kit Case Opener Spring Bar Cool Watch Unique Watch Fashion Watch","image_alt":null,"price":"HKD $260.61","image_src":"http://litbimg6.rightinthebox.com/images/500x500/201209/zsoxkf1346639845076.jpg","link":"http://localhost:8080/13-piece-watch-repair-tool-kit-case-opener-spring-bar_p391516.html","state":"29.00% Off","btn_style":"2"},{"title":"RWATCH R6 Wearable Smartwatch,Compass/Hands-Free Calls/Pedometer/Sleep Tracker for Android/iOS","image_alt":null,"price":"HKD $382.27","image_src":"http://litbimg6.rightinthebox.com/images/500x500/201409/nqadfb1411888268788.jpg","link":"http://localhost:8080/rwatch-luxury-r6-smartwatch-with-pedometer-sleep-test-compass-anti-theft-warning-camera-notification-alarm-clock_p2034904.html","state":"31.00% Off","btn_style":"2"},{"title":"CURREN®Men‘s Round Dial Alloy Band Quartz Analog Wrist Watch (Assorted Colors) Cool Watch Unique Watch Fashion Watch","image_alt":null,"price":"HKD $121.57","image_src":"http://litbimg2.rightinthebox.com/images/500x500/201402/jmnnrq1393231608715.jpg","link":"http://localhost:8080/men-s-round-dial-alloy-band-quartz-analog-wrist-watch-assorted-colors_p1091054.html","state":"0.00% Off","btn_style":"2"},{"title":"Men‘s Business Round Diamond Dial Mineral Glass Mirror Stainless Steel Band Fashion Mechanical Waterproof Watch Wrist Watch Cool Watch Unique Watch","image_alt":null,"price":"HKD $486.55","image_src":"http://litbimg1.rightinthebox.com/images/500x500/201511/jnposr1446705018947.jpg","link":"http://localhost:8080/men-s-high-end-business-round-diamond-dial-mineral-glass-mirror-stainless-steel-band-fashion-mechanical-waterproof-watch_p4531974.html","state":"24.00% Off","btn_style":"2"}]},"block8":{"products":[{"title":"Watches Men Luxury Brand Quartz Watches Men Wristwatch Male Clock relojes hombre Relogio Masculino montre homme","image_alt":null,"price":"HKD $165.02","image_src":"http://litbimg6.rightinthebox.com/images/500x500/201608/wlpzuw1470976804335.jpg","link":"http://localhost:8080/watches-men-luxury-brand-quartz-watches-men-wristwatch-male-clock-relojes-hombre-relogio-masculino-montre-homme_p5171888.html","state":"25.00% Off","btn_style":"2"},{"title":"Business Quartz Watch Men Sport Watches Men Corium Crocodile Leather Strap wristwatch clock hours Complete Unisex Watch","image_alt":null,"price":"HKD $86.81","image_src":"http://litbimg4.rightinthebox.com/images/500x500/201608/issjcn1470648963556.jpg","link":"http://localhost:8080/business-quartz-watch-men-sport-watches-men-corium-crocodile-leather-strap-wristwatch-clock-hours-complete-unisex-watch_p5157720.html","state":"24.00% Off","btn_style":"2"},{"title":"Watch Repair Tool Kit Adjustable Back Case Opener Cover Remover Screw Watchmaker Open Battery","image_alt":null,"price":"HKD $86.81","image_src":"http://litbimg5.rightinthebox.com/images/500x500/201312/psqpuu1388480749456.jpg","link":"http://localhost:8080/case-opener-for-watches_p998841.html","state":"24.00% Off","btn_style":"2"},{"title":"U8 Wearable Smartwatch,Camera Message Media Control/Hands-Free Calls/Anti-lost for Android/iOS Smartphone","image_alt":null,"price":"HKD $138.95","image_src":"http://litbimg4.rightinthebox.com/images/500x500/201411/odeu1415847247194.jpg","link":"http://localhost:8080/join-new-smart-touch-bluetooth-watch-for-sansumg-lg-google-all-android-smart-phone_p1455947.html","state":"31.00% Off","btn_style":"2"},{"title":"V6® Men‘s Watch Japanese Quartz Military Gold Case Rubber Band  Cool Watch Unique Watch Fashion Watch","image_alt":null,"price":"HKD $78.12","image_src":"http://litbimg8.rightinthebox.com/images/500x500/201511/ruw1448503444323.jpg","link":"http://localhost:8080/men-s-sports-rubber-style-analog-quartz-wrist-watch-black_p361222.html","state":"26.00% Off","btn_style":"2"},{"title":"V6® Men‘s Watch Dress Watch Simple Style Bronze Round Dial Cool Watch Unique Watch Fashion Watch","image_alt":null,"price":"HKD $43.36","image_src":"http://litbimg2.rightinthebox.com/images/500x500/201508/wcgs1440483896235.jpg","link":"http://localhost:8080/men-s-simple-style-bronze-round-dial-pu-band-quartz-wrist-watch-assorted-colors_p1764961.html","state":"29.00% Off","btn_style":"2"},{"title":"Smart Watch Q18 with Touch Screen Camera  for Android and IOS Phone","image_alt":null,"price":"HKD $434.41","image_src":"http://litbimg1.rightinthebox.com/images/500x500/201606/xvkzfk1464857458764.jpg","link":"http://localhost:8080/smart-watch-q18-with-touch-screen-camera-for-android-and-ios-phone_p5003599.html","state":"24.00% Off","btn_style":"2"},{"title":"RWATCH M26 Wearable Smartwatch,Media Control/Hands-Free Calls/Pedometer/Anti-lost for Android/iOS","image_alt":null,"price":"HKD $147.64","image_src":"http://litbimg6.rightinthebox.com/images/500x500/201406/nypoas1404117035508.jpg","link":"http://localhost:8080/rwatch-luxury-m26-bluetooth-smart-led-watch-with-call-answer-sms-music-player-anti-lost-thermometer_p1553463.html","state":"44.00% Off","btn_style":"2"}]},"block9":{"products":[{"title":"JUBAOLI® Men‘s Watch Military Roman Numeral Big Black Dial Casual Watch Cool Watch Unique Watch Fashion Watch","image_alt":null,"price":"HKD $52.05","image_src":"http://litbimg7.rightinthebox.com/images/500x500/201407/zdxxrb1406797146931.jpg","link":"http://localhost:8080/men-s-military-style-big-black-dial-brown-pu-band-quartz-wrist-watch-assorted-colors_p1697665.html","state":"26.00% Off","btn_style":"2"},{"title":"Men Wide Belt,Work / Casual Leather All Seasons","image_alt":null,"price":"HKD $147.64","image_src":"http://litbimg5.rightinthebox.com/images/500x500/201406/tevugn1403083549911.jpg","link":"http://localhost:8080/men-s-fashionable-dress-leather-belt_p1510466.html","state":"0.00% Off","btn_style":"2"},{"title":"SKMEI® Men‘s Watch Military Sports Multi-Function LCD Water Resistant/Water Proof Chronograph Calendar Shock Resistant  Cool Watch Unique Watch","image_alt":null,"price":"HKD $86.81","image_src":"http://litbimg7.rightinthebox.com/images/500x500/201405/oqknzw1400666693618.jpg","link":"http://localhost:8080/men-s-multi-functional-round-dial-silicone-band-led-digital-wrist-watch-assorted-color_p1262674.html","state":"24.00% Off","btn_style":"2"},{"title":"Men‘s  Watch Quartz Casual Wrist Watch Alloy Band Fashion Watch Cool Watch Unique Watch","image_alt":null,"price":"HKD $60.74","image_src":"http://litbimg6.rightinthebox.com/images/500x500/201208/uaaudj1346407947497.jpg","link":"http://localhost:8080/men-s-alloy-analog-quartz-casual-watch-assorted-colors_p391184.html","state":"23.00% Off","btn_style":"2"},{"title":"Men's U8 Smart Watch Bluetooth V3.0 Hand-Free Call Function","image_alt":null,"price":"HKD $138.95","image_src":"http://litbimg5.rightinthebox.com/images/500x500/201409/xqdu1409656251002.jpg","link":"http://localhost:8080/men-s-u8-watch-smartwatch-assorted-colors_p2069021.html","state":"31.00% Off","btn_style":"2"},{"title":"CURREN®Men‘s Watch Dress Watch Calendar Casual Watch Steel Band Black Cool Watch Unique Watch Fashion Watch","image_alt":null,"price":"HKD $112.88","image_src":"http://litbimg2.rightinthebox.com/images/500x500/201608/bqg1470392948587.jpg","link":"http://localhost:8080/men-s-round-dial-alloy-band-quartz-analog-wrist-watch_p1091056.html","state":"52.00% Off","btn_style":"2"},{"title":"V8 1.54‘‘ Touch Screen Smart Bluetooth 4.0 Watch Phone Supports Supports 2.0MP Camera  and Single SIM Bluetooth Function","image_alt":null,"price":"HKD $225.85","image_src":"http://litbimg5.rightinthebox.com/images/500x500/201411/hcgjlc1416871118700.jpg","link":"http://localhost:8080/v8-1-54-touch-screen-smart-bluetooth-4-0-watch-phone-supports-supports-2-0mp-camera-and-single-sim-bluetooth-function_p2350108.html","state":"17.00% Off","btn_style":"2"},{"title":"Men's Dresses , Cotton Casual Voboom","image_alt":null,"price":"HKD $25.98","image_src":"http://litbimg5.rightinthebox.com/images/500x500/201408/otxhil1408517808826.jpg","link":"http://localhost:8080/voboom-men-s-long-sleeve-shirt_p1827390.html","state":"77.00% Off","btn_style":"2"}]}}
EO;


$data = json_decode($data_str, true);

foreach ($data as $k=>$v) {
    $template->set($k, $v);
}
$template->set('is_mini', false);
echo $template->execute();

error_reporting($prevReporting);
*/