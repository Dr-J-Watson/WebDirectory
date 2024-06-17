import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:webdirapp/screens/entry_preview.dart';
import 'package:webdirapp/screens/entry_provider.dart';
import 'package:webdirapp/models/entry.dart';

class DirectoryMaster extends StatefulWidget {
  const DirectoryMaster({super.key});

  @override
  State<DirectoryMaster> createState() => _DirectoryMasterState();
}

class _DirectoryMasterState extends State<DirectoryMaster> {
  late Future<List<Entry>> entries;
  final EntryProvider entryProvider = EntryProvider();
  bool sortOrder = true;
  String? filterValue;
  String? researchValue;
  List<DropdownMenuItem<String>> services = [];
  

  @override
  void initState() {
    super.initState();
    services = entryProvider.getServices();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        
        title: TextField(
          decoration: const InputDecoration(
            icon: Icon(Icons.search),
            hintText: 'Rechercher un contact',
          ),
          onSubmitted: (String value) {
            setState(() {
              researchValue = value;
            });
          },
        ),
        actions: [
          IconButton(
          icon: const Icon(Icons.sort_by_alpha),
          onPressed: () {
            setState(() {
              sortOrder = !sortOrder;
            });
          },
          ),
          Padding(
            padding: const EdgeInsets.all(8.0),
            child:IconButton(
              icon: const Icon(Icons.filter_alt),
              onPressed: () {
                showDialog(
                  context: context,
                  builder: (BuildContext context) {
                    return AlertDialog(
                      title: const Text('Filtrer par Service/Département'),
                      content: Column(
                        mainAxisSize: MainAxisSize.min,
                        children: <Widget>[
                          DropdownButton(
                            value: filterValue,
                            items: services,
                            onChanged: (String? value) {
                              setState(() {
                                filterValue = value;
                                Navigator.pop(context);
                              });
                            },
                          ),
                          
                        ],
                      ),
                    );
                  }
                );
              },
            ),
          ),
        ],
        backgroundColor: Colors.white,
        shape: const Border(
          bottom: BorderSide(
            color: Colors.black,
          )
        ),
      ),
      body: Consumer<EntryProvider>(builder: (context, entryProvider, child) {
        return FutureBuilder(
          future: entryProvider.getEntries(sortOrder,researchValue,filterValue),
          builder: (BuildContext context, AsyncSnapshot<List<Entry>> snapshot) {
            if(snapshot.connectionState == ConnectionState.waiting) {
              return const Center(
                child: CircularProgressIndicator(),
              );
            } else if (snapshot.hasError) {
              return const Center(
                child: Text('Erreur de chargement des données'),
              );
            } else if (snapshot.hasData){
              return ListView.builder(
                itemCount: snapshot.data!.length,
                itemBuilder: (BuildContext context, int index) {
                  Entry entry = snapshot.data![index];
                  return EntryPreview(entry: entry, entryProvider: entryProvider,);
                },
              );
            } else {
              return const Center(
                child: Text("Aucune donnée n'a été trouvée"),
              );
            }
          },
        );
      }
    ),
    );
  }
}