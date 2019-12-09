<h1 align="center"> webservice </h1>

<p align="center"> A weather SDK.</p>


## Installing

```shell
$ composer require overtrue/webservice -vvv
```

## Webservice

基于 高德开放平台 的 PHP 天气信息组件,地理查询，驾车行驶路线

## 配置

在使用本扩展之前，你需要去 高德开放平台 注册账号，然后创建应用，获取应用的 API Key。

## 使用
```
use Overtrue\Webservice\Direction;

use Overtrue\Webservice\GeographyCode;

use Overtrue\Webservice\Weather;

require __DIR__ .'/vendor/autoload.php';


$key = '29a30658500d3fb53499217eaa016037';
```
### 天气查询
```
$weather = new Weather($key);
$response = $weather->getWeather('广州', 'all');
```
###### base:返回实况天气

###### all:返回预报天气

参考地址：https://lbs.amap.com/api/webservice/guide/api/weatherinfo/

### 地理编码查询

```
$geography_code = new GeographyCode($key);
$response = $geography_code->getGeographyCode("大石小学","广州")
```
###### 第一个参数 查询地址 
###### 第二个参数 城市

参考地址：https://lbs.amap.com/api/webservice/guide/api/georegeo

### 驾车行驶
```
$direction= new Direction($key);
$response = $direction->getDirection('116.481028,39.989643','116.434446,39.90816','all');
```
###### 第一个参数 出发的经度，纬度 
###### 第二个参数 到达的经度，纬度 

参考地址：https://lbs.amap.com/api/webservice/guide/api/direction
