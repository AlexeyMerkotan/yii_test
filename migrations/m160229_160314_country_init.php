<?php

use yii\db\Migration;

class m160229_160314_country_init extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%country}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(45)->notNull(),
            'phone_code' => $this->integer(5)->unsigned()->notNull(),
        ], $tableOptions);

        $this->batchInsert('{{%country}}', ['id', 'name', 'phone_code'], [
            // European Union
            [1, 'United States', 1],
            [2, 'Canada', 1],
            [3, 'United Kingdom', 44],
            [4, 'Australia', 61],
            [5, 'Abkhazia', 7],
            [6, 'Afghanistan', 93],
            [7, 'Ajaria', 995],
            [8, 'Akrotiri and Dhekelia', 357],
            [9, 'Albania', 355],
            [10, 'Algeria', 213],
            [11, 'American Samoa', 1684],
            [12, 'Andorra', 376],
            [13, 'Angola', 244],
            [14, 'Anguilla', 1264],
            [15, 'Antigua and Barbuda', 1268],
            [16, 'Argentina', 54],
            [17, 'Armenia', 374],
            [18, 'Aruba', 297],
            [19, 'Austria', 43],
            [20, 'Azerbaijan', 994],
            [21, 'Bahamas', 1242],
            [22, 'Bahrain', 973],
            [23, 'Bangladesh', 880],
            [24, 'Barbados', 1246],
            [25, 'Belarus', 375],
            [26, 'Belgium', 32],
            [27, 'Belize', 501],
            [28, 'Benin', 229],
            [29, 'Bermuda', 1441],
            [30, 'Bhutan', 975],
            [31, 'Bolivia', 591],
            [32, 'Bosnia and Herzegovina', 387],
            [33, 'Botswana', 267],
            [34, 'Brazil', 55],
            [35, 'British Antarctic Territory', 0],
            [36, 'British Indian Ocean Territory', 246],
            [37, 'British Virgin Islands', 1284],
            [38, 'Brunei', 673],
            [39, 'Bulgaria', 359],
            [40, 'Burkina Faso', 226],
            [41, 'Burma', 95],
            [42, 'Burundi', 257],
            [43, 'Cambodia', 855],
            [44, 'Cameroon', 237],
            [45, 'Cape Verde', 238],
            [46, 'Cayman Islands', 1345],
            [47, 'Central African Republic', 236],
            [48, 'Chad', 235],
            [49, 'Chile', 56],
            [50, 'China', 86],
            [51, 'Christmas Island', 61],
            [52, 'Cocos (Keeling) Islands', 61],
            [53, 'Colombia', 57],
            [54, 'Comoros', 269],
            [55, 'Congo-Brazzaville', 242],
            [56, 'Congo-Kinshasa', 243],
            [57, 'Cook Islands', 682],
            [58, 'Costa Rica', 506],
            [59, "Cote d'Ivoire", 225],
            [60, 'Crimea', 380],
            [61, 'Croatia', 385],
            [62, 'Cuba', 53],
            [63, 'Cyprus', 357],
            [64, 'Czech Republic', 420],
            [65, 'Denmark', 45],
            [66, 'Djibouti', 253],
            [67, 'Dominica', 1767],
            [68, 'Dominican Republic', 1809],
            [69, 'East Timor', 670],
            [70, 'Ecuador', 593],
            [71, 'Egypt', 20],
            [72, 'El Salvador', 503],
            [73, 'Equatorial Guinea', 240],
            [74, 'Eritrea', 291],
            [75, 'Estonia', 372],
            [76, 'Ethiopia', 251],
            [77, 'Falkland Islands', 500],
            [78, 'Faroe Islands', 298],
            [79, 'Federated States of Micronesia', 691],
            [80, 'Fiji', 679],
            [81, 'Finland', 358],
            [82, 'France', 33],
            [83, 'French Southern and Antarctic Lands', 262],
            [84, 'Gabon', 241],
            [85, 'Gambia', 220],
            [86, 'Georgia', 995],
            [87, 'Germany', 49],
            [88, 'Ghana', 233],
            [89, 'Gibraltar', 350],
            [90, 'Greece', 30],
            [91, 'Greenland', 299],
            [92, 'Grenada', 1473],
            [93, 'Guam', 1671],
            [94, 'Guatemala', 502],
            [95, 'Guinea', 224],
            [96, 'Guinea-Bissau', 245],
            [97, 'Guyana', 592],
            [98, 'Haiti', 509],
            [99, 'Honduras', 504],
            [100, 'Hong Kong', 852],
            [101, 'Hungary', 36],
            [102, 'Iceland', 354],
            [103, 'India', 91],
            [104, 'Indonesia', 62],
            [105, 'Iran', 98],
            [106, 'Iraq', 964],
            [107, 'Ireland', 353],
            [108, 'Israel', 972],
            [109, 'Italy', 39],
            [110, 'Jamaica', 1876],
            [111, 'Japan', 81],
            [112, 'Jordan', 962],
            [113, 'Karakalpakstan', 998],
            [114, 'Kazakhstan', 7],
            [115, 'Kenya', 254],
            [116, 'Kiribati', 686],
            [117, 'Kosovo', 381],
            [118, 'Kuwait', 965],
            [119, 'Kyrgyzstan', 996],
            [120, 'Laos', 856],
            [121, 'Latvia', 371],
            [122, 'Lebanon', 961],
            [123, 'Lesotho', 266],
            [124, 'Liberia', 231],
            [125, 'Libya', 218],
            [126, 'Liechtenstein', 423],
            [127, 'Lithuania', 370],
            [128, 'Luxembourg', 352],
            [129, 'Macau', 853],
            [130, 'Macedonia', 389],
            [131, 'Madagascar', 261],
            [132, 'Malawi', 265],
            [133, 'Malaysia', 60],
            [134, 'Maldives', 960],
            [135, 'Mali', 223],
            [136, 'Malta', 356],
            [137, 'Marshall Islands', 692],
            [138, 'Mauritania', 222],
            [139, 'Mauritius', 230],
            [140, 'Mayotte', 262],
            [141, 'Mexico', 52],
            [142, 'Moldova', 373],
            [143, 'Monaco', 377],
            [144, 'Mongolia', 976],
            [145, 'Montenegro', 382],
            [146, 'Montserrat', 1664],
            [147, 'Morocco', 212],
            [148, 'Mozambique', 258],
            [149, 'Nagorno-Karabakh Republic', 374],
            [150, 'Namibia', 264],
            [151, 'Nauru', 674],
            [152, 'Nepal', 977],
            [153, 'Netherlands', 31],
            [154, 'Netherlands Antilles', 599],
            [155, 'New Caledonia', 687],
            [156, 'New Zealand', 64],
            [157, 'Nicaragua', 505],
            [158, 'Niger', 227],
            [159, 'Nigeria', 234],
            [160, 'Niue', 683],
            [161, 'Norfolk Island', 672],
            [162, 'North Korea', 850],
            [163, 'Northern Cyprus', 90392],
            [164, 'Northern Mariana Islands', 1670],
            [165, 'Norway', 47],
            [166, 'Oman', 968],
            [167, 'Pakistan', 92],
            [168, 'Palau', 680],
            [169, 'Palestine', 970],
            [170, 'Panama', 507],
            [171, 'Papua New Guinea', 675],
            [172, 'Paraguay', 595],
            [173, 'Peru', 51],
            [174, 'Philippines', 63],
            [175, 'Pitcairn Islands', 870],
            [176, 'Poland', 48],
            [177, 'Polynesia', 689],
            [178, 'Portugal', 351],
            [179, 'Puerto Rico', 1],
            [180, 'Qatar', 974],
            [181, 'Romania', 40],
            [182, 'Russia', 7],
            [183, 'Rwanda', 250],
            [184, 'Saint Barthelemy', 590],
            [185, 'Saint Helena', 290],
            [186, 'Saint Kitts and Nevis', 1869],
            [187, 'Saint Lucia', 1758],
            [188, 'Saint Martin', 1599],
            [189, 'Saint Pierre and Miquelon', 508],
            [190, 'Saint Vincent and the Grenadines', 1784],
            [191, 'Samoa', 685],
            [192, 'San Marino', 378],
            [193, 'Sao Tome and Principe', 239],
            [194, 'Saudi Arabia', 966],
            [195, 'Senegal', 221],
            [196, 'Serbia', 381],
            [197, 'Seychelles', 248],
            [198, 'Sierra Leone', 232],
            [199, 'Singapore', 65],
            [200, 'Slovakia', 421],
            [201, 'Slovenia', 386],
            [202, 'Solomon Islands', 677],
            [203, 'Somalia', 252],
            [204, 'Somaliland', 252],
            [205, 'South Africa', 27],
            [206, 'South Georgia and the South Sandwich Islands', 500],
            [207, 'South Korea', 82],
            [208, 'South Ossetia', 99534],
            [209, 'Spain', 34],
            [210, 'Sri Lanka', 94],
            [211, 'Sudan', 249],
            [212, 'Suriname', 597],
            [213, 'Swaziland', 268],
            [214, 'Sweden', 46],
            [215, 'Switzerland', 41],
            [216, 'Syria', 963],
            [217, 'Taiwan', 886],
            [218, 'Tajikistan', 992],
            [219, 'Tanzania', 255],
            [220, 'Thailand', 66],
            [221, 'Togo', 228],
            [222, 'Tokelau', 690],
            [223, 'Tonga', 676],
            [224, 'Transnistria', 373],
            [225, 'Trinidad and Tobago', 1868],
            [226, 'Tunisia', 216],
            [227, 'Turkey', 90],
            [228, 'Turkmenistan', 993],
            [229, 'Turks and Caicos Islands', 1649],
            [230, 'Tuvalu', 688],
            [231, 'Uganda', 256],
            [232, 'Ukraine', 380],
            [233, 'United Arab Emirates', 971],
            [234, 'United States Virgin Islands', 1340],
            [235, 'Uruguay', 598],
            [236, 'Uzbekistan', 998],
            [237, 'Vanuatu', 678],
            [238, 'Vatican City', 379],
            [239, 'Venezuela', 58],
            [240, 'Vietnam', 84],
            [241, 'Wallis and Futuna', 681],
            [242, 'Western Sahara', 212],
            [243, 'Yemen', 967],
            [244, 'Zambia', 260],
            [245, 'Zimbabwe', 263],
        ]);

        //$this->addForeignKey('fk_user_country', '{{%user}}', 'country_id', '{{%country}}', 'id', 'SET NULL', 'CASCADE');
    }

    public function safeDown()
    {
        //$this->dropForeignKey('fk_user_country', '{{%user}}');
        $this->dropTable('{{%country}}');
    }
}
