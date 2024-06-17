import unittest
from zmiana_wielkosci import zmiana_wielkosci
from PIL import Image

class test_zmiana_wielkosci(unittest.TestCase):

    def setUp(self):
        # Dane przykladowego obrazka do funkcji zmiana_wielkosci
        self.input_image = 'test_input.jpg'
        self.output_image = 'test_output.jpg'
        self.new_width = 100
        self.new_height = 100
        # Wykonanie testowego obrazu
        with Image.new('RGB', (200, 200)) as img:
            img.save(self.input_image)

    def test_zmiana_wielkosci(self):
        zmiana_wielkosci(self.input_image, self.output_image, self.new_width, self.new_height)
        # Sprawdzenie wielkosci przekonwertowanego obrazu z danymi wczesniej wielkosciami
        with Image.open(self.output_image) as img:
            self.assertEqual(img.size, (self.new_width, self.new_height))

    def tearDown(self):
        # Funkcja usuwa wykonane wczesniej testowe obrazy
        import os
        os.remove(self.input_image)
        os.remove(self.output_image)

if __name__ == '__main__':
    unittest.main()
