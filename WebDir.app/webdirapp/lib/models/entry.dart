class Entry{

  String lastName;
  String firstName;
  String function;
  String numBureau;
  String telFixe;
  String telMobile;
  String email;
  String? image;
  List<String> departements;

  Entry({
    required this.lastName, 
    required this.firstName, 
    required this.function,
    required this.numBureau, 
    required this.telFixe, 
    required this.telMobile, 
    required this.email,
    required this.departements, 
    this.image
  });

  factory Entry.fromJson(Map<String, dynamic> json) {
    return switch (json){
      {
      'lastName': String lastName,
      'firstName': String firstName,
      'fonction' : String fonction,
      'numBureau': String numBureau,
      'telFixe': String telFixe,
      'telMobile': String telMobile,
      'email': String email,
      'image': String? image,
      'departements': List<String> departements,
      } =>
      Entry(
        lastName: lastName,
        firstName: firstName,
        function: fonction,
        numBureau: numBureau,
        telFixe: telFixe,
        telMobile: telMobile,
        email: email,
        image: image,
        departements: departements,
      ),
      _ => throw Exception('Impossible de charger le profil de la Entryne'),
    };  
  }
}