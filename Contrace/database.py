import sqlite3
import face_recognition
import numpy as np
import cv2
import io
import os


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


def findEncodings(stored_images):
    encodes = []
    for image in stored_images:
        image = cv2.cvtColor(image, cv2.COLOR_BGR2RGB)
        encode = face_recognition.face_encodings(image)
        encodes.append(encode)
    return encodes


con = sqlite3.connect("../includes/proj.sq3", detect_types=sqlite3.PARSE_DECLTYPES)
cur = con.cursor()
cur.execute('''DROP TABLE ENCODINGS''')
cur.execute('''CREATE TABLE ENCODINGS (NAME VARCHAR(50), ENCODES array)''')

path = '../user_images'
images = []
classNames = []
myList = os.listdir(path)
for cl in myList:
    curImg = cv2.imread(f'{path}/{cl}')
    images.append(curImg)
    classNames.append(os.path.splitext(cl)[0])
encodeListKnown = findEncodings(images)
print('Encoding complete')

for i in range(len(classNames)):
    print(encodeListKnown[i])
    print("x")
    x = encodeListKnown[i]
    print(type(x))
    x = np.array(x)
    print(type(x))
    cur.execute('''INSERT INTO ENCODINGS (NAME, ENCODES) VALUES(?,?)''', (classNames[i], x,))
# cur.execute("SELECT * FROM ENCODINGS")
# data = cur.fetchall()
# print("y")
# for i in range(len(data)):
#     print(data[i][1])
con.commit()

