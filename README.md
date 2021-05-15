# Contrace

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