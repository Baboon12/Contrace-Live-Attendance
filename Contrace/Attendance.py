import cv2
import numpy as np
import face_recognition
import pathlib
from datetime import datetime, date
import pandas as pd
import math
import os
import sqlite3
import io

def adapt_array(arr):
    out = io.BytesIO()
    np.save(out, arr)
    out.seek(0)
    return sqlite3.Binary(out.read())


def convert_array(text):
    out = io.BytesIO(text)
    out.seek(0)
    return np.load(out)


# Converts np.array to TEXT when inserting
sqlite3.register_adapter(np.ndarray, adapt_array)

# Converts TEXT to np.array when selecting
sqlite3.register_converter("array", convert_array)


# extract names of images
path = '../user_images'
images = []
classNames = []
myList = os.listdir(path)
#print(myList)
for cl in myList:
    curImg = cv2.imread(f'{path}/{cl}')
    images.append(curImg)
    classNames.append(os.path.splitext(cl)[0])

# find encodings of the images
def findEncodings():
    encodeList = []
    classNames = []
    con = sqlite3.connect("../includes/proj.sq3", detect_types=sqlite3.PARSE_DECLTYPES)
    cur = con.cursor()
    cur.execute("SELECT * FROM ENCODINGS")
    data = cur.fetchall()
    for i in range(len(data)):
        x = np.array(data[i][1])
        encodeList.append(x)
        classNames.append(str(data[i][0]))
    print(type(encodeList))
    encodeList = list(encodeList)
    return encodeList, classNames


# mark attendance of the person
def markAttendance(user_name):
    filename = date.today().strftime("%d-%m-%Y")
    fileloc = pathlib.Path("csv_files/" + filename + ".csv")
    # create a new csv file with name as today's date if does not exists
    if not fileloc.exists():
        with open("csv_files/" + filename + ".csv", "w") as f:
            f.writelines("NAME,IN TIME,OUT TIME")
    # open the csv file with the name as today's date
    with open('csv_files/' + filename + '.csv', 'r+') as f:
        # read the csv File
        myDataList = f.readlines()
        nameList = []
        for line in myDataList:
            entry = line.split(',')
            nameList.append(entry[0])
        # check if the name already exists in the csv file
        if user_name not in nameList:
            now = datetime.now()
            dtString = now.strftime('%H:%M:%S')
            f.writelines(f'\n{name},{dtString},')
        # if name exists check if its out time is recorded or not
        elif user_name in nameList:
            r = pd.read_csv("csv_files/" + filename + ".csv")
            for i in range(len(r)):
                try:
                    if r.loc[i, 'NAME'] == user_name and math.isnan(r.loc[i, 'OUT TIME']):
                        r.loc[i, 'OUT TIME'] = datetime.now().strftime("%H:%M:%S")
                except TypeError:
                    break
            # rewrite the updated info to csv file
                r.to_csv("csv_files/" + filename + ".csv", index=False)


encodeListKnown, classNames = findEncodings()
temp_list = []
for x in encodeListKnown:
    for y in x:
        temp_list.append(y)
encodeListKnown = temp_list
print('Encoding Complete')
cap = cv2.VideoCapture(0, cv2.CAP_DSHOW)

while True:
    # read the image and resize it to get a clear image
    success, img = cap.read()
    imgS = cv2.resize(img, (0, 0), None, 0.25, 0.25)
    imgS = cv2.cvtColor(imgS, cv2.COLOR_BGR2RGB)
    name = "Unknown"
    # find the face encodings of the person in camera 
    facesCurFrame = face_recognition.face_locations(imgS)
    encodesCurFrame = face_recognition.face_encodings(imgS, facesCurFrame)
    for encodeFace, faceLoc in zip(encodesCurFrame, facesCurFrame):
        try:
            # match the face encoding from the camera with the known encodings
            matches = face_recognition.compare_faces(encodeListKnown, encodeFace)
            faceDis = face_recognition.face_distance(encodeListKnown, encodeFace)
        except IndexError:
            print("Face not detected")
            break
        matchIndex = np.argmin(faceDis)
        if matches[matchIndex]:
            name = classNames[matchIndex].upper()

        # create a square around the face on screen and write the name of person below it
        y1, x2, y2, x1 = faceLoc
        y1, x2, y2, x1 = y1 * 4, x2 * 4, y2 * 4, x1 * 4
        cv2.rectangle(img, (x1, y1), (x2, y2), (0, 255, 0), 2)
        cv2.rectangle(img, (x1, y2 - 35), (x2, y2), (0, 255, 0), cv2.FILLED)
        cv2.putText(img, name, (x1 + 6, y2 - 6), cv2.FONT_HERSHEY_COMPLEX, 1, (255, 255, 255), 2)
    if name == "Unknown":
        cv2.imshow('Webcam', img)
        cv2.waitKey(1)
    elif name != "Unknown":
        cv2.imshow('Webcam', img)
        cv2.waitKey(5000)
        markAttendance(name)
        break


