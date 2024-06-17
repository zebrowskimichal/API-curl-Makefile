from PIL import Image

#Funkcja zmienia wielkosc danego obrazka na wpisana nowa wielkosc
def zmiana_wielkosci(path, output, new_width, new_height):
    with Image.open(path) as img:
        resized_img = img.resize((new_width, new_height))
        resized_img.save(output)

if __name__ == "__main__":
    import sys
    zmiana_wielkosci(sys.argv[1], sys.argv[2], int(sys.argv[3]), int(sys.argv[4]))
