from fastapi import FastAPI, HTTPException
from pydantic import BaseModel
import os
import sys

# Agar bisa mengimpor predict_pcos saat dijalankan dari root direktori Laravel
sys.path.append(os.path.dirname(os.path.abspath(__file__)))

from predict_pcos import predict

app = FastAPI(title="PCOS Detection API")

class PredictRequest(BaseModel):
    image_path: str

@app.get("/")
def read_root():
    return {"message": "PCOS Detection API is running"}

@app.post("/predict")
def do_prediction(request: PredictRequest):
    if not os.path.exists(request.image_path):
        raise HTTPException(status_code=400, detail="Image not found.")
    
    try:
        result = predict(request.image_path)
        return result
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))
