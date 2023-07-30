
import qrcode
from PIL import Image, ImageDraw, ImageFont
import sys

def generate_custom_qr_code(id_no, username):
    data = f"ID: {id_no}, Username: {username}"

    # Load the QR code template image
    qr_template_path = "/LibMSv1/users/admin/qrbin/qrcode.png"  # Replace with the path to your QR code template
    qr_template = Image.open(qr_template_path)

    # Create a QR code using the provided data
    qr = qrcode.QRCode(version=1, box_size=10, border=5)
    qr.add_data(data)
    qr.make(fit=True)

    # Make a black and white version of the QR code
    qr_image = qr.make_image(fill_color="black", back_color="white")

    # Calculate the position to paste the QR code onto the template
    qr_position = ((qr_template.width - qr_image.width) // 2, (qr_template.height - qr_image.height) // 2)

    # Paste the QR code onto the template
    qr_template.paste(qr_image, qr_position)

    # Draw the data (ID and username) on the template
    draw = ImageDraw.Draw(qr_template)
    'font = ImageFont.truetype("arial.ttf", size=20)  # Replace "arial.ttf" with the path to your preferred font'
    data_text = f"ID: {id_no}\nUsername: {username}"
    text_width, text_height = draw.textsize(data_text, font=font)
    text_position = ((qr_template.width - text_width) // 2, qr_position[1] + qr_image.height + 10)
    draw.text(text_position, data_text, font=font, fill="black")

    # Save the modified QR code image
    qr_template.save('/LibMSv1/users/admin/qrbin/qrcode_custom.png')


if __name__ == "__main__":
    if len(sys.argv) != 3:
        print("Usage: python generate_qr.py <ID_no> <Username>")
        sys.exit(1)

    id_no = sys.argv[1]
    username = sys.argv[2]

    generate_custom_qr_code(id_no, username)
