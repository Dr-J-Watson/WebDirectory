import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:webdirapp/screens/person_preview.dart';
import 'package:webdirapp/screens/person_provider.dart';
import 'package:webdirapp/models/person.dart';

class DirectoryMaster extends StatefulWidget {
  const DirectoryMaster({super.key});

  @override
  State<DirectoryMaster> createState() => _DirectoryMasterState();
}

class _DirectoryMasterState extends State<DirectoryMaster> {
  late Future<List<Person>> persons;
  final PersonProvider personProvider = PersonProvider();

  @override
  void initState() {
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Consumer<PersonProvider>(builder: (context, personProvider, child) {
        return FutureBuilder(
          future:personProvider.getPersons(),
          builder: (BuildContext context, AsyncSnapshot<List<Person>> snapshot) {
            if(snapshot.connectionState == ConnectionState.waiting) {
              return const Center(
                child: CircularProgressIndicator(),
              );
            } else if (snapshot.hasError) {
              return const Center(
                child: Text('Erreur de chargement des données'),
              );
            } else {
              return ListView.builder(
                itemCount: snapshot.data!.length,
                itemBuilder: (BuildContext context, int index) {
                  return PersonPreview(
                    person: snapshot.data![index],
                    personProvider: personProvider,
                  );
                },
              );
            }
          },
        );
      }
    ),
    );
  }
}