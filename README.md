# 基于wifi的室内人流密度统计（MAC&RSSI）

这个项目是由[SB Admin](http://startbootstrap.com/template-overviews/sb-admin/)改编而成。

[SB Admin](http://startbootstrap.com/template-overviews/sb-admin/) is an open source, admin dashboard template for [Bootstrap](http://getbootstrap.com/) created by [Start Bootstrap](http://startbootstrap.com/).

## Preview

![Preview](C:\Users\wl\Desktop\codes\image\preview.png)



## Status

![plain](C:\Users\wl\Desktop\codes\image\plain.jpg)

## Download and Installation（系统框架图）

![deposit](C:\Users\wl\Desktop\codes\image\deposit.png)

## Usage

### 思路

wifiprobe的原理是利用智能设备商WIFI模块所发出的无线广播信号进行设备的感知，就像是网站上的Cookie，他会记录你的访问行为和轨迹。不同的是，通过手机MAC地址所采集的是你的线下行为轨迹，比如喜欢逛什么地方，一周逛几次。

通过对采集MAC地址数据的分析与统计，可以把握周围环境的客流情况，精准监控客流质量，实时展示客流转化情况，从而帮助检测营销效果，发现潜在机会和改进措施，为便捷、高效精细化运营提供全方位数据参考。

该系统包括智能WiFi设备和后台服务器两个部分，同时依据功能实现将其划分成各个模块。智能WiFi设备包含嗅探抓包、数据传输两个模块，主要以基于OpenWRT系统的智能WiFi设备为载体，实现捕获设备MAC地址及RSSI值等信息并上传至服务器。服务器包含数据接收、数据处理、前端显示三个模块。

主要依靠每个智能设备MAC地址的唯一性，实现对智能设备MAC地址的统计转换为对人流量的统计。

```mermaid
graph LR
    A[人流统计系统]  --> B((智能wifi设备))
    A --> C(服务器)
    B --> D{硬件系统开发移植}
    D --> E[数据传送模块]
    C --> F{服务器环境搭建}
    F --> G[数据接收模块]
    F --> H[数据处理模块]
    F --> I[前端显示模块]
    
    
```

​                                                                                    系统功能模块图



### 予以考虑的室内终端设备

首先我们要考虑到环境中终端的复杂性：实际环境中的终端，通常有几种情况：未开启WiFi、开启WiFi但没有接入热点、开启WiFi且接入热点、将手机作为热点以及非手机等智能设备（如路由器、打印机等其他硬件设备），还有可能出现的情况是一人多部手机。我们只考虑开启WiFi的手机设备。（包括安卓和苹果手机）

###数据库

整个被动定位系统最重要的无疑是WiFi探针采集到的数据，接下来，我会把四个探针写入8张表的数据做详细介绍，我以1号探针举例子，也就是介绍两张表，另外3个探针除了表名不一样外，表的字段完全一致。

![mysql](C:\Users\wl\Desktop\codes\image\mysql.png)

![phpadmin](C:\Users\wl\Desktop\codes\image\phpadmin.png)

4个探针未通电之前，全是空表，不插入数据。

###表00f92b8c

| Row_id | id   | mmac | rate | wssid | wmac | date | lat  | lon  | addr |
| ------ | ---- | ---- | ---- | ----- | ---- | ---- | ---- | ---- | ---- |
|        |      |      |      |       |      |      |      |      |      |

| 行数   | 1号探针设备的id号 | 1号探针设备自身的mac地址 | 发送频率1s | 不详   | 不详   | 时间戳  | 纬度   | 经度   | 地址   |
| ---- | ---------- | -------------- | ------ | ---- | ---- | ---- | ---- | ---- | ---- |
|      |            |                |        |      |      |      |      |      |      |

 

###表00f92b8c_detail

| Row_id | Master_id | time | mac  | rssi | range | ts   | tc   | tmc  | ds   |
| ------ | --------- | ---- | ---- | ---- | ----- | ---- | ---- | ---- | ---- |
|        |           |      |      |      |       |      |      |      |      |

| 行数   | 我没搞明白这个字段意思 | 时间戳  | 采集到的手机MAC地址 | 手机信号强度 | 距离探针多少米（非常不准） | 目标ssid，手机连接的WIFI的ssid（有时候采集不到） | 是否与路由器相连（有时候不准） | 手机连接的WIFI的mac地址（如果有那么准确有时候采集不到） | 手机是否睡眠（也不准确） |
| ---- | ----------- | ---- | ----------- | ------ | ------------- | ------------------------------ | --------------- | ------------------------------- | ------------ |
|      |             |      |             |        |               |                                |                 |                                 |              |

#### 假设实际情况

- 环境有一个小米手机，连了一个热点（tc），这个热点叫ra0（ts），这个热点有一个mac地址（tmc）

ps.其余六张表是另外3个探针产生的，具体含义不再做介绍。

## Copyright and License

Copyright © 重庆大学大数据与智慧计算课题组 2018