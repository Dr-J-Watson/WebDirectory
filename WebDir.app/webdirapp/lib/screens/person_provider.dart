import 'package:flutter/material.dart';
import 'package:webdirapp/models/person.dart';
import 'package:faker/faker.dart' as fakerref;


class PersonProvider extends ChangeNotifier {
  List<Person> _persons = [];
  List<Person> get persons => _persons;

  Future<List<Person>> getPersons() async{
    await fetchPersons();
    return _persons;
  }

  void addPerson(Person person) {
    _persons.add(person);
    notifyListeners();
  }

  void removePerson(Person person) {
    _persons.remove(person);
    notifyListeners();
  }


  Future<void> fetchPersons() async {
    await Future.delayed(const Duration(seconds: 1));
    final faker = fakerref.Faker();
    _persons = List.generate(10, (index) {
      return Person(
        firstName: faker.person.firstName(),
        lastName: faker.person.lastName(),
        numBureau: faker.guid.guid(),
        image: null,
        email: faker.internet.email(),
        telFixe: faker.phoneNumber.us(),
        telMobile: faker.phoneNumber.us(),
      );
    });
  }
}