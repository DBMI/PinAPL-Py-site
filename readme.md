<p align="center"><img src="https://github.com/DBMI/PinAPL-Py-site/blob/master/public/img/logo_with_name.png" width="100px"></p>

## **P**latform-**in**dependent **A**nalysis of **P**oo**L**ed screens using **Py**thon

## About

This a a website built for the CRISPR CAS9 pipeline <a href="https://github.com/LewisLabUCSD/PinAPL-Py">PinAPL-Py</a> written by Philipp Spahn.

It is written mainly in PHP using the php framework <a href="https://laravel.com/">Laravel</a>

We use a custom file upload server written in nodeJS which allows for the upload of large files. The larges we tested was 300GB

## Installation & Setup
Clone this repository to where you would like to host the site. E.g. /var/www/

The site comes with a setup script included in setup/setup.sh. This script is more of a guideline, and is written for ubuntu 16.04. It is not thoroughly tested and should not be used for production machines. 
``` sudo bash setup/setup.sh ```

After installation and setup open the .env file and fill in any empty variables, and change any that are incorrect. 

## License

This code is licensed under the [MIT license](http://opensource.org/licenses/MIT).
