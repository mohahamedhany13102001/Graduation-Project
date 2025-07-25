import tensorflow as tf
from tensorflow import keras
from keras.preprocessing import image
import numpy as np
import cv2
import sys
import os


imagePath = sys.argv[1]

# print(random.randint(0, 3))
# exit()

IMG_SIZE = (256, 256)
retina_model = keras.models.load_model(os.path.join("core",'model.h5'))
img = cv2.imread(imagePath)
img = cv2.cvtColor(img,cv2.COLOR_BGR2GRAY)
img = cv2.equalizeHist(img)
img = cv2.cvtColor(img,cv2.COLOR_GRAY2BGR)
img = tf.image.resize(img, (256,256))
img = np.expand_dims(img/255, 0)
pred_Y = retina_model.predict(img, verbose = False)
pred_Y_cat = np.argmax(pred_Y, -1)

print(pred_Y_cat[0])
