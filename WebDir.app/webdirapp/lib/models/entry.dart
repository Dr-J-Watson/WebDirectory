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
  List<String> departements;

  Entry({
    required this.lastName, 
    required this.firstName, 
    required this.function,
    required this.numBureau, 
    this.telFixe, 
    this.telMobile, 
    required this.email,
    required this.departements, 
    this.image
  });

  Entry.fromJson(Map<String, dynamic> json)
      : lastName = json['entree']['nom'],
        firstName = json['entree']['prenom'],
        function = json['entree']['fonction'],
        numBureau = json['entree']['numeroBureau'].toString(),
        telMobile = json['entree']['numeroTel1'],
        telFixe = json['entree']['numeroTel2'],
        email = json['entree']['email'],
        departements = List<String>.from(json['entree']['departement'].map((item) => item.toString())),
        image = json['links']['image'] != null ? 'https://cataas.com/cat' : null; //'${dotenv.env['BASE_URL']}${dotenv.env['PORT']}${json['links']['image']}';

}