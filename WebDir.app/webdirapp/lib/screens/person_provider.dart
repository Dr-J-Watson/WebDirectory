import 'package:flutter/material.dart';
import 'package:webdirapp/models/person.dart';

class PersonProvider extends ChangeNotifier {
  List<Person> _persons = [];
  List<Person> get persons => _persons;

  void addPerson(Person person) {
    _persons.add(person);
    notifyListeners();
  }

  void removePerson(Person person) {
    _persons.remove(person);
    notifyListeners();
  }
}