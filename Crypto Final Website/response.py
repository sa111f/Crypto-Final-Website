import smtplib
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart

def send_report_response(name, email, location, details):
    # Sender email credentials
    sender_email = "pritampyare2121@gmail.com"  # Replace with your email
    sender_password = "Soni@0000"  # Replace with your email password
    recipient_email = "weareprofessionals01@gmail.com"  # Fixed recipient

    # Email subject and body
    subject = "New Cryptosporidium Case Report"
    body = f"""
    A new case has been reported:

    Name: {name}
    Email: {email}
    Location: {location}
    Details: {details}

    Please take the necessary actions.
    """

    # Create email message
    msg = MIMEMultipart()
    msg['From'] = sender_email
    msg['To'] = recipient_email
    msg['Subject'] = subject
    msg.attach(MIMEText(body, 'plain'))

    try:
        # Connect to SMTP server and send email
        with smtplib.SMTP('smtp.gmail.com', 587) as server:  # Replace with your SMTP server
            server.starttls()
            server.login(sender_email, sender_password)
            server.sendmail(sender_email, recipient_email, msg.as_string())
            print("Email sent successfully!")
    except Exception as e:
        print(f"Error sending email: {e}")

# Example usage
# Replace these with the form data
name = "John Doe"
email = "johndoe@example.com"
location = "Dubai"
details = "Patient showing symptoms of diarrhea and dehydration."

send_report_response(name, email, location, details)
