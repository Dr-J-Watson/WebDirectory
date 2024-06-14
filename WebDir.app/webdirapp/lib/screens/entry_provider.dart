import 'package:flutter/material.dart';
import 'package:webdirapp/models/entry.dart';
import 'package:faker/faker.dart' as fakerref;
import 'package:http/http.dart' as http;


class EntryProvider extends ChangeNotifier {
  List<Entry> _entries = [];

  Future<List<Entry>> getentries(bool sortOrder) async{
    await fetchentries(sortOrder);
    return _entries;
  }

  void addEntry(Entry entry) {
    _entries.add(entry);
    notifyListeners();
  }

  void removeEntry(Entry entry) {
    _entries.remove(entry);
    notifyListeners();
  }


  Future<void> fetchentries(bool sortOrder) async {
    await Future.delayed(const Duration(seconds: 1));
    final List<String> deps = ["Informatique", "Ressources Humaines", "Comptabilité", "Direction", "Commercial", "Communication", "Production", "Logistique", "Maintenance", "Qualité"];
    final faker = fakerref.Faker();
    _entries = List.generate(10, (index) {
      int numDeps = faker.randomGenerator.integer(3, min: 1);
      List<String> departements = List.generate(numDeps, (index) => deps[faker.randomGenerator.integer(deps.length)]);
      return Entry(
        firstName: faker.person.firstName(),
        lastName: faker.person.lastName(),
        function: faker.company.position(),
        numBureau: faker.guid.guid(),
        image: faker.randomGenerator.boolean() ? "https://cataas.com/cat" : null,
        departements: departements,
        email: faker.internet.email(),
        telFixe: faker.phoneNumber.us(),
        telMobile: faker.phoneNumber.us(),
      );
    });

    if (sortOrder) {
      _entries.sort((a, b) => a.lastName.compareTo(b.lastName));
    } else {
      _entries.sort((a, b) => b.lastName.compareTo(a.lastName));
    }

    /*final response = await http.get(Uri.parse('https://jsonplaceholder.typicode.com/users'));
    if (response.statusCode == 200) {
      final List<dynamic> entries = jsonDecode(response.body);
      _entries = entries.map((e) => Entry.fromJson(e)).toList();
    } else {
      throw Exception('Impossible de charger les Entrynes (code d\'erreur : ${response.statusCode})');
    }*/

  }
}