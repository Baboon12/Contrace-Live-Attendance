# Contrace

<img src="https://github.com/Baboon12/Contrace-Live-Attendace/blob/main/user_images/Contrace%20-%203.png" alt="Contrace Logo">
There are two major parts of this project:
1. Attendance.py - This is where face recognition happens
2. Website - For administration
<br>



## Installation
1. For Attendance.py

Install  [Visual Studio](https://visualstudio.microsoft.com/downloads/) - Also Install "Desktop Development with C++" in the Workloads section

```shell
pip install cmake
```

```shell
pip install opencv
```

```shell
pip install dlib
```

```shell
pip install face-recognition
```

```shell
pip install numpy
```

2. For Website

Install [Xampp](https://www.apachefriends.org/download.html)


## Steps For Starting the Server

After Xampp Installation open "php.ini" file

Search for "sqlite" and uncomment any instances with sqlite by removing ";" from the start of that particular line

Open Xampp Control Panel and Start the Apache Server

Go to `C:\xampp\htdocs` or whatever installation path you chose during xampp installation

Keep all the project related files here

Open a Browser and type `localhost\folder_name`. This should take you to the Website

To run the actual face recognition project: Run `folder_name\Contrace\attendance.bat`


## Authors

(alphabetically)
- [@Bhavya Sura](https://www.github.com/Baboon12)
- [@Darshil Sanghvi](https://github.com/darshilsanghvi)
- [@Pratham Dedhiya](https://github.com/prathamdedhiya17)

## Badges

[![GPLv3 License](https://img.shields.io/badge/License-GPL%20v3-yellow.svg)](https://opensource.org/licenses/)
[![Project](https://img.shields.io/badge/Project-Contrace--Live%20Attendance-green)](https://opensource.org/licenses/) 
[![Authors](https://img.shields.io/badge/Authors-Bhavya%20Sura%2C%20Darshil%20Sanghvi%20and%20Pratham%20Dedhiya%20-orange)](https://opensource.org/licenses/)
