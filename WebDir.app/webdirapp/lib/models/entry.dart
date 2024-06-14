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
      : lastName = json['nom'],
        firstName = json['prenom'],
        function = json['fonction'],
        numBureau = json['numeroBureau'].toString(),
        telMobile = json['numeroTel1'],
        telFixe = json['numeroTel2'],
        email = json['email'],
        departements = List<String>.from(json['departement'].map((item) => item.toString())),
        image = 'https://cataas.com/cat';

}