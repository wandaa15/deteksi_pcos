import os
import sys
import json
import cv2
import numpy as np
import tensorflow as tf

# ==========================================================
# Konfigurasi
# ==========================================================

IMG_SIZE = (224, 224)

MODEL_PATH = os.path.join(
    os.path.dirname(os.path.dirname(__file__)),
    "..",
    "storage",
    "app",
    "pcos_mobilenetv2.keras"
)

# ==========================================================
# CLAHE
# ==========================================================

def apply_clahe(
    gray_img,
    clip_limit=2.0,
    tile_grid=(8,8)
):

    clahe = cv2.createCLAHE(
        clipLimit=clip_limit,
        tileGridSize=tile_grid
    )

    return clahe.apply(gray_img)


# ==========================================================
# Noise Reduction
# ==========================================================

def apply_noise_reduction(
    gray_img,
    method="median",
    ksize=3
):

    if method == "median":

        return cv2.medianBlur(
            gray_img,
            ksize
        )

    elif method == "bilateral":

        return cv2.bilateralFilter(
            gray_img,
            9,
            75,
            75
        )

    elif method == "gaussian":

        return cv2.GaussianBlur(
            gray_img,
            (ksize,ksize),
            0
        )

    else:

        raise ValueError("Unknown noise reduction method.")


# ==========================================================
# Follicle Enhancement
# ==========================================================

def enhance_follicles(
    gray_img,
    kernel_size=11,
    edge_weight=0.25,
    morph_weight=0.40
):

    kernel = cv2.getStructuringElement(
        cv2.MORPH_ELLIPSE,
        (kernel_size,kernel_size)
    )

    blackhat = cv2.morphologyEx(
        gray_img,
        cv2.MORPH_BLACKHAT,
        kernel
    )

    lap = cv2.Laplacian(
        gray_img,
        cv2.CV_32F,
        ksize=3
    )

    lap = cv2.convertScaleAbs(lap)

    enhanced = cv2.addWeighted(
        gray_img,
        1.0,
        blackhat,
        morph_weight,
        0
    )

    enhanced = cv2.addWeighted(
        enhanced,
        1.0,
        lap,
        edge_weight,
        0
    )

    enhanced = cv2.normalize(
        enhanced,
        None,
        0,
        255,
        cv2.NORM_MINMAX
    )

    return enhanced.astype(np.uint8)


# ==========================================================
# Preprocess
# ==========================================================

def preprocess_image(image_path):

    img = cv2.imread(
        image_path,
        cv2.IMREAD_GRAYSCALE
    )

    if img is None:

        raise Exception(
            "Cannot read image."
        )

    # CLAHE
    img = apply_clahe(img)

    # Median Blur
    img = apply_noise_reduction(
        img,
        method="median",
        ksize=3
    )

    # Follicle Enhancement
    img = enhance_follicles(img)

    # Resize
    img = cv2.resize(
        img,
        IMG_SIZE,
        interpolation=cv2.INTER_AREA
    )

    # RGB
    img = cv2.cvtColor(
        img,
        cv2.COLOR_GRAY2RGB
    )

    img = img.astype(np.float32)

    img = tf.keras.applications.mobilenet_v2.preprocess_input(
        img
    )

    img = np.expand_dims(
        img,
        axis=0
    )

    return img


# ==========================================================
# Load Model (sekali saja)
# ==========================================================

MODEL = tf.keras.models.load_model(
    MODEL_PATH
)

# ==========================================================
# Predict Function
# ==========================================================

def predict(image_path):
    """
    Melakukan prediksi pada satu citra USG ovarium.
    """

    img = preprocess_image(image_path)

    prediction = MODEL.predict(
        img,
        verbose=0
    )[0][0]

    prediction = float(prediction)

    threshold = 0.50

    if prediction >= threshold:
        label = "Normal"
        confidence = prediction * 100
    else:
        label = "PCOS"
        confidence = (1 - prediction) * 100

    return {

        "success": True,

        "prediction": label,

        "confidence": round(confidence, 2),

        "score": round(prediction, 6)

    }


# ==========================================================
# Main
# ==========================================================

def main():

    try:

        if len(sys.argv) < 2:

            print(json.dumps({

                "success": False,

                "error": "No image path provided."

            }))

            return


        image_path = sys.argv[1]


        if not os.path.exists(image_path):

            print(json.dumps({

                "success": False,

                "error": "Image not found."

            }))

            return


        result = predict(image_path)

        print(

            json.dumps(

                result,

                ensure_ascii=False

            )

        )


    except Exception as e:

        print(

            json.dumps({

                "success": False,

                "error": str(e)

            })

        )


# ==========================================================
# Entry Point
# ==========================================================

if __name__ == "__main__":

    # Mengurangi log TensorFlow
    os.environ["TF_CPP_MIN_LOG_LEVEL"] = "3"

    main()