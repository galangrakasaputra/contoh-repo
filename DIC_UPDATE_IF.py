def ubah_data(data,key,value):
    if key in data:
        data[key] = value
    else :
        return "Key tidak ditemukan"


    
data = {"nama":"Devri",
        "umur" : 26,
        "Hobi": "game"}

ubah_data(data,"umur", 29)

hasil =ubah_data(data,"alamat","jakarta")
print(data)
print(hasil)