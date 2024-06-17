import 'package:flutter_dotenv/flutter_dotenv.dart';

class Entry{

  String lastName;
  String firstName;
  String function;
  String numBureau;
  String? telFixe;
  String? telMobile;
  String email;
  String? image;
  List<String> services;

  Entry({
    required this.lastName, 
    required this.firstName, 
    required this.function,
    required this.numBureau, 
    this.telFixe, 
    this.telMobile, 
    required this.email,
    required this.services, 
    this.image
  });

  Entry.fromJson(Map<String, dynamic> json)
      : lastName = json['entree']['lastName'],
        firstName = json['entree']['firstName'],
        function = json['entree']['fonction'],
        numBureau = json['entree']['numBureau'].toString(),
        telMobile = json['entree']['telFixe'],
        telFixe = json['entree']['telMobile'],
        email = json['entree']['email'],
        services = List<String>.from(json['entree']['services'].map((item) => item.toString())),
        image = json['entree']['image'] != null ? '${dotenv.env['IMAGE_URL']}${json['entree']['image']}' : null;

}